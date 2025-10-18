<?php

use Core\App;
use Http\Forms\ReservationForm;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Models\Reservation;

$origRes = App::resolve(Reservation::class)->fetchReservationById($_POST["id"]);

ReservationForm::validate($_POST);

$facilityRate = App::resolve(ReservationHelper::class)->getFacilityRate($_POST["time_range"], $_POST['facility']);
$total_price = App::resolve(ReservationHelper::class)->getReservationTotalPrice($facilityRate, $_POST);
$check_out = App::resolve(ReservationHelper::class)->calculateCheckOut($_POST["check_in"], $_POST["time_range"]);

$updatedReservation = [
    "facility_id" => $_POST["facility"],
    "contact_person" => $_POST["contact_person"],
    "contact_no" => $_POST["contact_no"],
    "contact_email" => $_POST["contact_email"],
    "contact_address" => $_POST["contact_address"],
    "check_in" => $_POST["check_in"],
    "time_range" => $_POST["time_range"],
    "check_out" => $check_out,
    "rent_videoke" => $_POST["rent_videoke"],
    "guest_count" => count($_POST["guests"]),
    "total_price" => $total_price,
    "status" => $_POST["status"]
];

App::resolve(Reservation::class)->updateReservation($origRes["id"], $updatedReservation);

App::resolve(ReservationHelper::class)->addGuestList($origRes["id"], $_POST["guests"]);

/** Set payment */
$origPayment = App::resolve(Payment::class)->fetchPaymentByReservationId($origRes["id"]);
$updatedPayment = [
    "id" => $origPayment["id"],
    "payment_method" => $origPayment["payment_method"],
    "payment_status" => $_POST["payment_status"],
];

App::resolve(Payment::class)->updatePayment($updatedPayment);

redirect("/admin/reservations");
