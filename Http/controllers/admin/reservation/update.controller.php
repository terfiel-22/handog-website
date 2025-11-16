<?php

use Core\App;
use Http\Forms\ReservationForm;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Models\Reservation;
use Http\Services\PaymentService;

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
    "extended_pool_hrs" => $_POST["extended_pool_hrs"],
    "extended_cottage_hrs" => $_POST["extended_cottage_hrs"],
    "additional_bed_count" => $_POST["additional_bed_count"],
    "guest_count" => count($_POST["guests"]),
    "total_price" => $total_price,
    "status" => $_POST["status"]
];

App::resolve(Reservation::class)->updateReservation($origRes["id"], $updatedReservation);

App::resolve(ReservationHelper::class)->updateGuestList($origRes["id"], $_POST["guests"]);

/** Set payment */
$origPayment = App::resolve(Payment::class)->fetchPaymentByReservationId($origRes["id"]);

if ($origPayment["payment_status"] != $_POST["payment_status"]) {
    $newPayment = [
        "reservation_id" => $origRes["id"],
        "amount" => PaymentService::amount($origRes["total_price"], $origRes["paid_amount"], $_POST["payment_status"]),
        "payment_method" => NULL,
        "payment_type" => PaymentService::paymentType($_POST["payment_status"]),
        "payment_status" => $_POST["payment_status"],
        "payment_link" => NULL,
    ];

    App::resolve(Payment::class)->createPayment($newPayment);
}

redirect("/admin/reservations");
