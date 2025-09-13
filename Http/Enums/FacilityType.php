<?php

namespace Http\Enums;

class FacilityType
{
    const ROOM = "room";
    const COTTAGE = "cottage";
    const EVENT_HALL = "event_hall";
    const EXCLUSIVE = "exclusive";

    /**
     * Get all the constant values as an array
     *
     * @return array
     */
    public static function toArray(): array
    {
        $reflection = new \ReflectionClass(self::class);
        return $reflection->getConstants();
    }
}
