<?php

namespace Http\Services;

use Core\App;
use Http\Models\Rates;

class RatesService
{
    protected static function ratesModel()
    {
        return App::resolve(Rates::class);
    }

    /**
     * Get current logo
     */
    public static function getRates()
    {
        $ratesModel = self::ratesModel();

        $rates = $ratesModel->fetchRates();

        if (!$rates) {
            return [
                "id" => 1,
                "adult_rate_day" => "120.00",
                "kid_rate_day" => "80.00",
                "adult_rate_night" => "200.00",
                "kid_rate_night" => "100.00",
                "senior_pwd_discount" => "0.20",
                "videoke_rent" => "1500.00",
                "additional_bed_rate" => "200.00",
                "pool_extension_rate_adult" => "50.00",
                "pool_extension_rate_kid" => "20.00",
                "cottage_extension_rate" => "250.00"
            ];
        }

        return $rates;
    }
}
