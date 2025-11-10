<?php

namespace Http\Helpers;

use Core\App;
use DateTime;
use Http\Enums\DiscountType;
use Http\Enums\GuestType;
use Http\Enums\ReservationTimeRange;
use Http\Enums\TimeSlot;
use Http\Enums\YesNo;
use Http\Helpers\EmailHelper;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Rates;
use Http\Models\ReservationGuest;

class ReservationHelper
{
    public function getFacilityRate($timeRange, $facilityId)
    {
        $facility = App::resolve(Facility::class)->fetchFacilityById($facilityId);
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

        $promos = App::resolve(Promo::class)->fetchOngoingPromos();

        $discountedRate = $initialRate;

        foreach ($promos as $promo) {
            $promoFacilities = array_map('intval', explode(',', $promo['facilities']));

            if (in_array((int) $facilityId, $promoFacilities)) {
                $discountValue = (float) $promo['discount_value'];
                $discountedValue = $promo['discount_type'] == DiscountType::PERCENTAGE_OFF ? ($initialRate * ($discountValue / 100)) : $discountValue;
                $discountedRate = max(0, $initialRate - $discountedValue);
                break;
            }
        }

        return round($discountedRate, 2);
    }


    public function getReservationTotalPrice($facilityRate, $data)
    {
        $miscRates = App::resolve(Rates::class)->fetchRates();
        // Get videoke rent
        $videokeRentRate = $_POST["rent_videoke"] == YesNo::YES ? $miscRates["videoke_rent"] : 0;

        // Get additonal bed count price 
        $additionalBedCountPrice = $data['additional_bed_count'] > 0 ? $data['additional_bed_count'] * $miscRates["additional_bed_rate"] : 0;

        // Initialize total price
        $total_price = $facilityRate + $videokeRentRate + $additionalBedCountPrice;

        // Get miscRates for adult and kid based on time slot
        $adultRate = $_POST["time_slot"] == TimeSlot::DAY ? $miscRates["adult_rate_day"] : $miscRates["adult_rate_night"];
        $kidRate = $_POST["time_slot"] == TimeSlot::DAY ? $miscRates["kid_rate_day"] : $miscRates["kid_rate_night"];

        // Get all the guests
        $guests = $data["guests"];

        foreach ($guests as $guest) {
            $isDiscounted = $guest["senior_pwd"] === YesNo::YES;
            $type = guestType($guest["guest_age"]);
            $guestRate =  $type == GuestType::ADULT
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
        // Delete all guests on this reservation
        App::resolve(ReservationGuest::class)->deleteReservationGuest($reservationId);

        // Create new
        foreach ($guests as $guest) {
            $guestType = guestType($guest["guest_age"]);
            $data = array_merge($guest, ["reservation_id" => $reservationId, "guest_type" => $guestType]);
            App::resolve(ReservationGuest::class)->createReservationGuest($data);
        }
    }

    public function calculateCheckOut(string $checkIn, string $timeRange): string
    {
        $checkInDate = new DateTime($checkIn);

        switch ($timeRange) {
            case ReservationTimeRange::RESERVE_8HRS:
                $checkInDate->modify('+8 hours');
                break;

            case ReservationTimeRange::RESERVE_12HRS:
                $checkInDate->modify('+12 hours');
                break;

            case ReservationTimeRange::RESERVE_1DAY:
                $checkInDate->modify('+1 day');
                break;

            default:
                return $checkIn;
        }

        return $checkInDate->format('Y-m-d H:i');
    }

    public function sendEmailForBookingConfirmation($userName, $checkInDate, $checkInTime, $userEmail)
    {
        $subject = 'Booking Confirmation – Handog Resort Reservation';
        $body = "
            <h2>Booking Confirmation</h2>
            <p>Dear <b>{$userName}</b>,</p>
            <p>Thank you for booking with us!</p>
            <p><b>Check-in Date:</b> {$checkInDate}<br>
            <b>Check-in Time:</b> {$checkInTime}</p>
            <p>Please note that <b>rebooking is allowed only 24 hours before your scheduled booking</b>.</p>
            <p>We look forward to your stay!</p>
            <br>
            <p>Best regards,<br>
            <b>Handog Resort Team</b></p>
        ";

        $altBody = "Dear {$userName},\n\n"
            . "Thank you for booking with us!\n"
            . "Check-in Date: {$checkInDate}\n"
            . "Check-in Time: {$checkInTime}\n\n"
            . "Note: Rebooking is allowed only 24 hours before your scheduled booking.\n\n"
            . "Best regards,\nHandog Resort Team";

        // Send email
        App::resolve(EmailHelper::class)->sendEmail($userEmail, $userName, $subject, $body, $altBody);
    }
}
