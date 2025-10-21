<?php

namespace Http\Services;

use Http\Enums\FacilityType;

class DashboardService
{
    /**
     * Get available facilities by type.
     */
    public static function availableFacilities(): array
    {
        return  [
            FacilityType::ROOM => 0,
            FacilityType::COTTAGE => 0,
        ];
    }

    /**
     * Get unavailable facilities by type.
     */
    public static function unavailableFacilities(): array
    {
        return   [
            FacilityType::ROOM => 0,
            FacilityType::COTTAGE => 0,
        ];
    }

    /**
     * Get total earnings for today.
     */
    public static function earningsToday(): float
    {
        return 0;
    }

    /**
     * Get total number of reservations made today.
     */
    public static function reservationsToday(): int
    {
        return 0;
    }

    /**
     * Get occupancy rate (rooms booked vs total rooms).
     */
    public static function occupancyRate(): float
    {
        $totalRooms = 0;
        $bookedRooms = 0;

        return $totalRooms > 0 ? round(($bookedRooms / $totalRooms) * 100, 2) : 0;
    }

    /**
     * Get earnings grouped by month (for chart).
     */
    public static function monthlyEarnings(): array
    {
        return [
            "month" => 1,
            "total" => 0
        ];
    }

    /**
     * Get top used facilities (for analytics).
     */
    public static function topFacilitiesUsage(): array
    {
        return [
            'facility' => "Standard Room",
            'type' => "Room",
            'usage_count' => 2,
        ];
    }

    /**
     * Summary dashboard metrics.
     */
    public static function summary(): array
    {
        return [
            'earnings_today' => self::earningsToday(),
            'reservations_today' => self::reservationsToday(),
            'occupancy_rate' => self::occupancyRate(),
            'available_facilities' => self::availableFacilities(),
            'unavailable_facilities' => self::unavailableFacilities(),
            'top_facilities_usage' => self::topFacilitiesUsage(),
            'monthly_earnings' => self::monthlyEarnings(),
        ];
    }
}
