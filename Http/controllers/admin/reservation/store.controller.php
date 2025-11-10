<?php

use Core\App;
use Http\Enums\PaymentMethod;
use Http\Enums\PaymentType;
use Http\Enums\ReservationStatus;
use Http\Forms\ReservationForm;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Models\Reservation;

ReservationForm::validate($_POST);

$facilityRate = App::resolve(ReservationHelper::class)->getFacilityRate($_POST["time_range"], $_POST['facility']);
$total_price = App::resolve(ReservationHelper::class)->getReservationTotalPrice($facilityRate, $_POST);
$check_out = App::resolve(ReservationHelper::class)->calculateCheckOut($_POST["check_in"], $_POST["time_range"]);

$reservation = [
    "facility_id" => $_POST["facility"],
    "contact_person" => $_POST["contact_person"],
    "contact_no" => $_POST["contact_no"],
    "contact_email" => $_POST["contact_email"],
    "contact_address" => $_POST["contact_address"],
    "check_in" => $_POST["check_in"],
    "time_range" => $_POST["time_range"],
    "check_out" => $check_out,
    "rent_videoke" => $_POST["rent_videoke"],
    "additional_bed_count" => $_POST["additional_bed_count"],
    "guest_count" => count($_POST["guests"]),
    "total_price" => $total_price,
    "status" => ReservationStatus::CONFIRMED
];

$reservationId = App::resolve(Reservation::class)->createReservation($reservation);

App::resolve(ReservationHelper::class)->addGuestList($reservationId, $_POST["guests"]);

/** Set payment */
$payment = [
    "reservation_id" => $reservationId,
    "amount" => $total_price,
    "payment_method" => PaymentMethod::CASH,
    "payment_type" => PaymentType::FULL,
    "payment_status" => $_POST["payment_status"],
    "payment_link" => NULL,
];

App::resolve(Payment::class)->createPayment($payment);

redirect("/admin/reservations");
