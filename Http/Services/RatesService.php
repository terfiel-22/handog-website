<?php

namespace Http\Services;

use Core\App;
use Http\Enums\DiscountType;
use Http\Enums\GuestType;
use Http\Enums\ReservationTimeRange;
use Http\Enums\TimeSlot;
use Http\Enums\YesNo;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Rates;

class RatesService
{
    protected static function ratesModel()
    {
        return App::resolve(Rates::class);
    }
    protected static function facilityModel()
    {
        return App::resolve(Facility::class);
    }
    protected static function promoModel()
    {
        return App::resolve(Promo::class);
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
                "id" => "",
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

    /**
     * Get guest rate
     */
    public static function getGuestRate($checkIn, $age, $isSeniorPwd)
    {
        $rates = self::getRates();
        $adult_rate = 0;
        $kid_rate = 0;

        if (isDaySlot($checkIn)) {
            $adult_rate = $rates["adult_rate_day"];
            $kid_rate = $rates["kid_rate_day"];
        } else {
            $adult_rate = $rates["adult_rate_night"];
            $kid_rate = $rates["kid_rate_night"];
        }

        $guestType = guestType($age);

        $guestRate = $guestType == GuestType::ADULT ? $adult_rate : $kid_rate;

        if ($isSeniorPwd === YesNo::YES) {
            $guestRate = $guestRate - ($guestRate * $rates["senior_pwd_discount"]);
        }

        return $guestRate;
    }

    /** Get Facility Rate */
    public static function getFacilityRate($timeRange, $facilityId)
    {
        $facilityModel = self::facilityModel();
        $facility = $facilityModel->fetchFacilityById($facilityId);
        $initialRate = 0;

        switch ($timeRange) {
            case ReservationTimeRange::RESERVE_8HRS:
                $initialRate = $facility["rate_8hrs"];
                break;
            case ReservationTimeRange::RESERVE_12HRS:
                $initialRate = $facility["rate_12hrs"];
                break;
            case ReservationTimeRange::RESERVE_1DAY:
                $initialRate = $facility["rate_1day"];
                break;
        }

        return $initialRate;
    }

    /** Get Current Discount Value */
    public static function getCurrentDiscountOnFacility($facilityId, $facilityRate)
    {
        $promoModel = self::promoModel();
        $promos = $promoModel->fetchOngoingPromos();
        $discountedValue = 0;
        foreach ($promos as $promo) {
            $promoFacilities = array_map('intval', explode(',', $promo['facilities']));
            if (in_array((int) $facilityId, $promoFacilities)) {
                $discountValue = (float) $promo['discount_value'];
                $discountedValue += $promo['discount_type'] == DiscountType::PERCENTAGE_OFF ? ($facilityRate * ($discountValue / 100)) : $discountValue;
            }
        }
        return $discountedValue;
    }

    /** Discounted Facility Rate */
    public static function getDiscountedFacilityRate($timeRange, $facilityId)
    {
        $facilityRate = self::getFacilityRate($timeRange, $facilityId);
        $discountedValue = self::getCurrentDiscountOnFacility($facilityId, $facilityRate);
        return max(0, $facilityRate - $discountedValue); // Return zero if exceeded the amount
    }

    /** Reservation Total Rate */
    public static function getReservationTotalPrice($data)
    {
        $rates = self::getRates();
        $discountedFacilityRate = self::getDiscountedFacilityRate($data["time_range"], $data["facility"]);

        // Get videoke rent
        $videokeRentRate = $data["rent_videoke"] == YesNo::YES ? $rates["videoke_rent"] : 0;

        // Get additonal bed count price 
        $additionalBedCountPrice = $data['additional_bed_count'] > 0 ? $data['additional_bed_count'] * $rates["additional_bed_rate"] : 0;

        // Initialize total price
        $total_price = $discountedFacilityRate + $videokeRentRate + $additionalBedCountPrice;

        // Get all the guests
        $guests = $data["guests"];

        foreach ($guests as $guest) {
            $total_price += self::getGuestRate($data["check_in"], $guest["guest_age"], $guest["senior_pwd"]);
        }

        return $total_price;
    }

    /** Reservation Deposit Rate */
    public static function bookingDeposit($total_amount)
    {
        return $total_amount / 2;
    }
}
