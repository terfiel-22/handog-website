<?php

namespace Core;

use DateTime;

class Validator
{
    public static function not_empty(string $value): bool
    {
        return strlen($value) > 0;
    }

    public static function not_empty_array(array $array): bool
    {
        return count($array) > 0;
    }

    public static function string(string $value, int $min = 1, float $max = INF): bool
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(string $value): bool
    {
        return (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function password_match(string $password, string $confirmPassword): bool
    {
        return $password === $confirmPassword;
    }

    public static function phone_number(string $value): bool
    {
        $pattern = '/^\+\d{12}$/';

        return preg_match($pattern, $value);
    }

    public static function future_date(string $date): bool
    {
        $currentDate = new DateTime();
        $date = new DateTime($date);

        return $date > $currentDate;
    }

    public static function quantity($value, int $min = 1, $max = INF): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        if (!is_int($value + 0)) {
            return false;
        }

        if ($value < $min || $value > $max) {
            return false;
        }

        return true;
    }


    public static function money($value, int $min = 1, $max = INF): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        if ($value < $min || $value > $max) {
            return false;
        }

        return true;
    }

    public static function in_options($value, $array): bool
    {
        return in_array($value, $array);
    }
}
