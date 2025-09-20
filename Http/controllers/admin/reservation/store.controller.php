<?php

use Core\App;
use Http\Enums\GuestType;
use Http\Enums\YesNo;
use Http\Models\EntranceRates;
use Http\Models\Facility;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;

// Get selected facility
$facility = App::resolve(Facility::class)->fetchFacilityById($_POST['facility']);
$facilityPrice = $facility["price"];

// Get Rate for timeslot 
$timeSlot = $_POST["time_slot"];
$rateByTimeslot = App::resolve(EntranceRates::class)->fetchEntranceRateByTimeSlot($timeSlot);

// Get rate for renting videoke
$videokeRentRate = $_POST["rent_videoke"] == YesNo::YES ? 1500 : 0;

// Get all the guests
$guests = $_POST["guests"];

// Function for computing total price
function getTotalPrice($facilityPrice, $videokeRentRate, $rateByTimeslot, $guests)
{
    $total_price = $facilityPrice + $videokeRentRate;

    foreach ($guests as $guest) {
        $isDiscounted = $guest["senior_pwd"] === YesNo::YES;

        $guestRate = $guest["guest_type"] === GuestType::ADULT
            ? $rateByTimeslot["adult_rate"]
            : $rateByTimeslot["kid_rate"];

        if ($isDiscounted) {
            $guestRate = $guestRate - ($guestRate * $rateByTimeslot["senior_pwd_discount"]);
        }

        $total_price += $guestRate;
    }

    return $total_price;
}

$total_price = getTotalPrice($facilityPrice, $videokeRentRate, $rateByTimeslot, $guests);

$reservation = [
    "facility_id" => $_POST["facility"],
    "entrance_rate_id" => $rateByTimeslot["id"],
    "contact_person" => $_POST["contact_person"],
    "contact_no" => $_POST["contact_no"],
    "contact_email" => $_POST["contact_email"],
    "contact_address" => $_POST["contact_address"],
    "rent_videoke" => $_POST["rent_videoke"],
    "guest_count" => count($guests),
    "total_price" => $total_price,
];

$reservationId = App::resolve(Reservation::class)->createReservation($reservation);

// Add all the guest to reservation_guests table
foreach ($guests as $guest) {
    $data = array_merge($guest, ["reservation_id" => $reservationId]);
    App::resolve(ReservationGuest::class)->createReservationGuest($data);
}

redirect("/admin/reservations");
