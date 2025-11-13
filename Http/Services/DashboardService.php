<?php

namespace Http\Services;

use Core\Database;
use Core\App;
use DateTime;
use Http\Enums\PaymentStatus;

class DashboardService
{
    protected static function db()
    {
        return App::resolve(Database::class);
    }

    public static function availableFacilities(): array
    {
        $db = self::db();
        $today = (new DateTime())->format('Y-m-d H:s');

        // Fetch all facilities with their available_unit
        $facilities = $db->query("
            SELECT id, type, name, available_unit
            FROM facilities
        ")->get();

        $result = [];

        foreach ($facilities as $facility) {
            // Count active reservations for this facility (today between check_in & check_out)
            $reserved = $db->query("
                SELECT COUNT(*) AS total
                FROM reservations
                WHERE facility_id = ?
                AND ? BETWEEN check_in AND check_out
            ", [$facility['id'], $today])->find();
            $reservedCount = (int)($reserved['total'] ?? 0);

            // Compute remaining available units
            $remainingUnits = max(0, (int)$facility['available_unit'] - $reservedCount);

            // Add to the grouped type result
            $result[] = [
                "name" => $facility['name'],
                "unit" => $remainingUnits
            ];
        }

        return $result;
    }

    public static function unavailableFacilities(): array
    {
        $db = self::db();
        $today = (new DateTime())->format('Y-m-d H:s');

        $facilities = $db->query("
            SELECT id, type, name, available_unit
            FROM facilities
        ")->get();

        $result = [];

        foreach ($facilities as $facility) {
            $reserved = $db->query("
                SELECT COUNT(*) AS total
                FROM reservations
                WHERE facility_id = ?
                AND ? BETWEEN check_in AND check_out
            ", [$facility['id'], $today])->find();

            $reservedCount = (int)($reserved['total'] ?? 0);

            // If all units are booked, mark as unavailable 
            $result[] = [
                "name" => $facility['name'],
                "unit" => $reservedCount
            ];
        }

        return $result;
    }

    public static function earningsToday(): float
    {
        $db = self::db();
        $today = (new DateTime())->format('Y-m-d');

        $result = $db->query("
            SELECT SUM(amount) as total 
            FROM payments 
            WHERE DATE(created_at) = ? 
            AND payment_status = ?
        ", [$today, PaymentStatus::PAID])->find();

        return (float) ($result['total'] ?? 0);
    }

    public static function reservationsToday(): int
    {
        $db = self::db();
        $today = (new DateTime())->format('Y-m-d');

        $result = $db->query("
            SELECT COUNT(*) as total 
            FROM reservations 
            WHERE DATE(check_in) = ?
        ", [$today])->find();

        return (int) ($result['total'] ?? 0);
    }

    public static function currentGuests(): int
    {
        $db = self::db();

        $guests = $db->query("
            SELECT SUM(guest_count) as total
            FROM reservations   
            WHERE check_in <= CURDATE()
            AND check_out > CURDATE()
        ")->find();

        return (int) ($guests['total'] ?? 0);
    }

    public static function occupancyRate(): array
    {
        $db = self::db();
        $today = (new DateTime())->format('Y-m-d H:i:s');

        // Fetch all facilities with their total units
        $facilities = $db->query("
            SELECT id, name, available_unit
            FROM facilities
        ")->get();

        $data = [];

        foreach ($facilities as $facility) {
            // Count booked units for this facility
            $booked = $db->query("
            SELECT COUNT(*) as total
            FROM reservations
            WHERE facility_id = ?
            AND ? BETWEEN check_in AND check_out
        ", [$facility['id'], $today])->find();

            $bookedUnits = (int) ($booked['total'] ?? 0);
            $totalUnits = (int) ($facility['available_unit'] ?? 0);

            $occupancyRate = $totalUnits > 0
                ? round(($bookedUnits / $totalUnits) * 100, 2)
                : 0;

            $data[] = [
                'facility_name' => $facility['name'],
                'booked_units' => $bookedUnits,
                'total_units' => $totalUnits,
                'occupancy_rate' => $occupancyRate,
            ];
        }

        return $data;
    }

    public static function totalVisits(): int
    {
        $db = self::db();

        $visit = $db->query("
            SELECT COUNT(*) as total
            FROM reservation_guests
            ")->find();

        return $visit["total"];
    }

    public static function forecastEarningsWithTrendline(int $daysBack = 30, int $daysAhead = 7): array
    {
        $db = self::db();

        $history = $db->query("
            SELECT 
                DATE(p.created_at) AS date,
                COALESCE(SUM(p.amount), 0) AS earnings
            FROM payments p
            WHERE p.payment_status = 'paid'
            AND DATE(p.created_at) BETWEEN DATE_SUB(CURDATE(), INTERVAL {$daysBack} DAY) AND CURDATE()
            GROUP BY DATE(p.created_at)
            ORDER BY DATE(p.created_at)
        ")->get();

        if (empty($history)) {
            return [
                'message' => 'No payment data available for forecast.',
                'forecast' => [],
                'todayForecast' => 0,
                'growthPercent' => 0
            ];
        }

        // Prepare regression data
        $x = [];
        $y = []; // earnings only

        $i = 0;
        foreach ($history as $row) {
            $x[] = $i++;
            $y[] = (float) $row['earnings'];
        }

        // Calculate regression (trendline)
        $trend = self::linearRegression($x, $y);

        // Forecast future values
        $forecast = [];
        for ($d = 1; $d <= $daysAhead; $d++) {
            $futureX = count($x) + $d - 1;
            $forecastDate = date('Y-m-d', strtotime("+{$d} day"));

            $forecast[] = [
                'date' => $forecastDate,
                'predicted_earnings' => max(0, $trend['a'] + $trend['b'] * $futureX)
            ];
        }

        // Today's and tomorrow's forecast
        $todayForecast = $forecast[0]['predicted_earnings'] ?? 0;
        $tomorrowForecast = $forecast[1]['predicted_earnings'] ?? 0;

        // Growth percentage
        $growthPercent = $todayForecast > 0
            ? round((($tomorrowForecast - $todayForecast) / $todayForecast) * 100, 2)
            : 0;

        return [
            'days_back' => $daysBack,
            'days_ahead' => $daysAhead,
            'historical' => $history,
            'forecast' => $forecast,
            'todayForecast' => $todayForecast,
            'growthPercent' => $growthPercent
        ];
    }

    private static function linearRegression(array $x, array $y): array
    {
        $n = count($x);
        if ($n === 0) return ['a' => 0, 'b' => 0];

        $sumX = array_sum($x);
        $sumY = array_sum($y);
        $sumXY = 0;
        $sumX2 = 0;

        for ($i = 0; $i < $n; $i++) {
            $sumXY += $x[$i] * $y[$i];
            $sumX2 += $x[$i] * $x[$i];
        }

        $b = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
        $a = ($sumY - $b * $sumX) / $n;

        return ['a' => $a, 'b' => $b];
    }


    public static function summary(): array
    {
        return [
            'earnings_today' => self::earningsToday(),
            'reservations_today' => self::reservationsToday(),
            'current_guests' => self::currentGuests(),
            'occupancy_rate' => self::occupancyRate(),
            'available_facilities' => self::availableFacilities(),
            'unavailable_facilities' => self::unavailableFacilities(),
            'earnings_analytics' => self::forecastEarningsWithTrendline(),
            'total_visits' => self::totalVisits(),
        ];
    }
}
