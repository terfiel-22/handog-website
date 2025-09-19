<?php

namespace Http\Enums;

class Enums
{
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
