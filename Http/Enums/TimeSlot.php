<?php

namespace Http\Enums;

class TimeSlot extends Enums
{
    const DAY = "day";
    const NIGHT = "night";

    public static function checkInTime($timeSlot)
    {
        $currentDate = date("Y-m-d");

        switch ($timeSlot) {
            case self::DAY:
                return $currentDate . " 06:00:00";
            default:
                return $currentDate . " 18:00:00";
        }
    }

    public static function checkOutTime($timeSlot)
    {
        $currentDate = date("Y-m-d");

        switch ($timeSlot) {
            case self::DAY:
                return $currentDate . " 17:00:00";
            default:
                return $currentDate . " 05:00:00";
        }
    }
}
