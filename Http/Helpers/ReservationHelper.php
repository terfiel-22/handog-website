<?php

namespace Http\Helpers;

use Core\App;
use Http\Enums\GuestType;
use Http\Enums\ReservationTimeRange;
use Http\Enums\TimeSlot;
use Http\Enums\YesNo;
use Http\Models\Facility;
use Http\Models\Rates;
use Http\Models\ReservationGuest;

class ReservationHelper
{
    public function getFacilityRate($timeRange, $facilityId)
    {
        // Get selected facility
        $facility = App::resolve(Facility::class)->fetchFacilityById($facilityId);
        switch ($timeRange) {
            case ReservationTimeRange::RESERVE_8HRS:
                return $facility["rate_8hrs"];
            case ReservationTimeRange::RESERVE_12HRS:
                return $facility["rate_12hrs"];
            case ReservationTimeRange::RESERVE_1DAY:
                return $facility["rate_1day"];
        }
    }

    public function getReservationTotalPrice($facilityRate, $data)
    {
        $miscRates = App::resolve(Rates::class)->fetchRates();
        // Get videoke rent
        $videokeRentRate = $_POST["rent_videoke"] == YesNo::YES ? $miscRates["videoke_rent"] : 0;

        // Initialize total price
        $total_price = $facilityRate + $videokeRentRate;

        // Get miscRates for adult and kid based on time slot
        $adultRate = $_POST["time_slot"] == TimeSlot::DAY ? $miscRates["adult_rate_day"] : $miscRates["adult_rate_night"];
        $kidRate = $_POST["time_slot"] == TimeSlot::DAY ? $miscRates["kid_rate_day"] : $miscRates["kid_rate_night"];

        // Get all the guests
        $guests = $data["guests"];

        foreach ($guests as $guest) {
            $isDiscounted = $guest["senior_pwd"] === YesNo::YES;

            $guestRate = $guest["guest_type"] === GuestType::ADULT
                ? $adultRate
                : $kidRate;

            if ($isDiscounted) {
                $guestRate = $guestRate - ($guestRate * $miscRates["senior_pwd_discount"]);
            }

            $total_price += $guestRate;
        }

        return $total_price;
    }

    public function addGuestList($reservationId, $guests)
    {
        foreach ($guests as $guest) {
            $data = array_merge($guest, ["reservation_id" => $reservationId]);
            App::resolve(ReservationGuest::class)->createReservationGuest($data);
        }
    }
}
