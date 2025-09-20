<?php

use Core\App;
use Http\Enums\GuestType;
use Http\Enums\YesNo;
use Http\Models\EntranceRates;
use Http\Models\Facility;

// dd($_POST);

// Get selected facility
$facility = App::resolve(Facility::class)->fetchFacilityById($_POST['facility']);

// Compute the total price
$total_price = $facility["price"];

// Get Rate for timeslot 
$timeSlot = $_POST["time_slot"];
$rateByTimeslot = App::resolve(EntranceRates::class)->fetchEntranceRateByTimeSlot($timeSlot);

$isRentingVideoke = $_POST["rent_videoke"] == YesNo::YES;
if ($isRentingVideoke) {
    $total_price += 1500; //Hard coded
}

$guests = $_POST["guests"];

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

dd($total_price);
