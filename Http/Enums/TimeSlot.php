<?php

namespace Http\Enums;

class TimeSlot extends Enums
{
    const DAY = "day";
    const NIGHT = "night";

    public function timeSlot($timeSlot)
    {
        switch ($timeSlot) {
            case self::DAY:
                return "6AM - 5PM";
            default:
                return "6PM - 5AM";
        }
    }
}
