<?php

namespace Http\Services;

use Http\Enums\FacilityType;
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

    /**
     * Get available facilities (based on available_unit - current reservations)
     */
    public static function availableFacilities(): array
    {
        $db = self::db();
        $today = (new DateTime())->format('Y-m-d H:s');

        // Fetch all facilities with their available_unit
        $facilities = $db->query("
            SELECT id, type, name, available_unit
            FROM facilities
        ")->get();

        $result = [
            FacilityType::ROOM => 0,
            FacilityType::COTTAGE => 0,
            FacilityType::EVENT_HALL => 0,
            FacilityType::EXCLUSIVE => 0,
        ];

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
            $result[$facility['type']] += $remainingUnits;
        }

        return $result;
    }

    /**
     * Get unavailable facilities (currently fully booked)
     */
    public static function unavailableFacilities(): array
    {
        $db = self::db();
        $today = (new DateTime())->format('Y-m-d H:s');

        $facilities = $db->query("
            SELECT id, type, name, available_unit
            FROM facilities
        ")->get();

        $result = [
            FacilityType::ROOM => 0,
            FacilityType::COTTAGE => 0,
            FacilityType::EVENT_HALL => 0,
            FacilityType::EXCLUSIVE => 0,
        ];

        foreach ($facilities as $facility) {
            $reserved = $db->query("
                SELECT COUNT(*) AS total
                FROM reservations
                WHERE facility_id = ?
                AND ? BETWEEN check_in AND check_out
            ", [$facility['id'], $today])->find();

            $reservedCount = (int)($reserved['total'] ?? 0);

            // If all units are booked, mark as unavailable
            if ($reservedCount >= (int)$facility['available_unit']) {
                $result[$facility['type']]++;
            }
        }

        return $result;
    }

    /**
     * Earnings, Reservations, etc. remain the same...
     */
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


    public static function summary(): array
    {
        return [
            'earnings_today' => self::earningsToday(),
            'reservations_today' => self::reservationsToday(),
            'occupancy_rate' => self::occupancyRate(),
            'available_facilities' => self::availableFacilities(),
            'unavailable_facilities' => self::unavailableFacilities(),
            'total_visits' => self::totalVisits(),
        ];
    }
}
