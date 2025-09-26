<?php

use Core\App;
use Http\Enums\GuestType;
use Http\Enums\ReservationStatus;
use Http\Enums\ReservationTimeRange;
use Http\Enums\TimeSlot;
use Http\Enums\YesNo;
use Http\Forms\ReservationForm;
use Http\Models\Facility;
use Http\Models\Rates;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;

ReservationForm::validate($_POST);

function getFacilityRate($timeRange)
{
    // Get selected facility
    $facility = App::resolve(Facility::class)->fetchFacilityById($_POST['facility']);
    switch ($timeRange) {
        case ReservationTimeRange::RESERVE_8HRS:
            return $facility["rate_8hrs"];
        case ReservationTimeRange::RESERVE_12HRS:
            return $facility["rate_12hrs"];
        case ReservationTimeRange::RESERVE_1DAY:
            return $facility["rate_1day"];
    }
}

$facilityRate = getFacilityRate($_POST["time_range"]);

// Function for computing total price
function getTotalPrice($facilityRate, $data)
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

$total_price = getTotalPrice($facilityRate, $_POST);

$reservation = [
    "facility_id" => $_POST["facility"],
    "contact_person" => $_POST["contact_person"],
    "contact_no" => $_POST["contact_no"],
    "contact_email" => $_POST["contact_email"],
    "contact_address" => $_POST["contact_address"],
    "check_in" => TimeSlot::checkInTime($_POST["time_slot"]),
    "check_out" => TimeSlot::checkOutTime($_POST["time_slot"]),
    "rent_videoke" => $_POST["rent_videoke"],
    "guest_count" => count($_POST["guests"]),
    "total_price" => $total_price,
    "status" => ReservationStatus::CONFIRMED
];

$reservationId = App::resolve(Reservation::class)->createReservation($reservation);

// Add all the guest to reservation_guests table
foreach ($_POST["guests"] as $guest) {
    $data = array_merge($guest, ["reservation_id" => $reservationId]);
    App::resolve(ReservationGuest::class)->createReservationGuest($data);
}

redirect("/admin/reservations");
