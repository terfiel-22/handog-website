<?php

use Core\App;
use Http\Enums\ReservationStatus;
use Http\Enums\TimeSlot;
use Http\Forms\BookingForm;
use Http\Helpers\ReservationHelper;

BookingForm::validate($_POST);

$facilityRate = App::resolve(ReservationHelper::class)->getFacilityRate($_POST["time_range"], $_POST['facility']);
$total_price = App::resolve(ReservationHelper::class)->getReservationTotalPrice($facilityRate, $_POST);

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
    "status" => ReservationStatus::PENDING
];

dd($reservation);
