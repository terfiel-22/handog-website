<?php

use Core\App;
use Http\Enums\AuditAction;
use Http\Enums\AuditModule;
use Http\Forms\ReservationForm;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Models\Reservation;
use Http\Services\AuditTrailService;
use Http\Services\PaymentService;
use Http\Services\RatesService;
use Http\Services\UserService;

$origRes = App::resolve(Reservation::class)->fetchReservationById($_POST["id"]);

$reservationForm = ReservationForm::validate($_POST);

$facilityRate = RatesService::getFacilityRate($_POST["time_range"], $_POST['facility']);
if ((int)$facilityRate < 1) {
    $reservationForm->error(
        "time_range",
        "The time range you selected is unavailable at the moment."
    )->throw();
}
$discountedValue = RatesService::getCurrentDiscountOnFacility($_POST['facility'], $facilityRate);
$total_price = RatesService::getReservationTotalPrice($_POST);
$check_out = App::resolve(ReservationHelper::class)->calculateCheckOut($_POST["check_in"], $_POST["time_range"]);
$guests = $_POST["guests"] ?? [];

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
    "discounted_value" => $discountedValue,
    "guest_count" => count($guests),
    "total_price" => $total_price,
    "status" => $_POST["status"]
];

App::resolve(Reservation::class)->updateReservation($origRes["id"], $updatedReservation);

/** Audit Log */
$user = UserService::getCurrentUser();
AuditTrailService::reservation_update_log(
    $user["id"],
    [
        "id" => $origRes["id"],
        "facility_id" => $origRes["facility_id"],
        "contact_person" => $origRes["contact_person"],
        "contact_no" => $origRes["contact_no"],
        "contact_email" => $origRes["contact_email"],
        "contact_address" => $origRes["contact_address"],
        "check_in" => $origRes["check_in"],
        "time_range" => $origRes["time_range"],
        "check_out" => $origRes["check_out"],
        "rent_videoke" => $origRes["rent_videoke"],
        "extended_pool_hrs" => $origRes["extended_pool_hrs"],
        "extended_cottage_hrs" => $origRes["extended_cottage_hrs"],
        "additional_bed_count" => $origRes["additional_bed_count"],
        "discounted_value" => $origRes["discounted_value"],
        "guest_count" => $origRes["guest_count"],
        "total_price" => $origRes["total_price"],
        "status" => $origRes["status"]
    ],
    array_merge(
        ["id" => $origRes["id"]],
        $updatedReservation
    )
);

App::resolve(ReservationHelper::class)->updateGuestList($origRes["id"], $guests);

/** Set payment */
$origPayment = App::resolve(Payment::class)->fetchPaymentByReservationId($origRes["id"]);
if (!empty($origPayment) && $origPayment["payment_status"] !== $_POST["payment_status"]) {
    $newPayment = [
        "reservation_id" => $origRes["id"],
        "amount" => PaymentService::amount($origRes["total_price"], $origRes["paid_amount"], $origRes["payment_status"], $_POST["payment_status"]),
        "payment_method" => NULL,
        "payment_type" => PaymentService::paymentType($_POST["payment_status"]),
        "payment_status" => $_POST["payment_status"],
        "payment_link" => NULL,
    ];

    $paymentId = App::resolve(Payment::class)->createPayment($newPayment);

    /** Audit Log */
    AuditTrailService::payment_update_log(
        $user["id"],
        [
            "id" => $origPayment["id"],
            "reservation_id" => $origRes["id"],
            "amount" => $origPayment["amount"],
            "payment_method" => $origPayment["payment_method"],
            "payment_type" => $origPayment["payment_type"],
            "payment_status" => $origPayment["payment_status"],
            "payment_link" => $origPayment["payment_link"],
        ],
        array_merge(
            ["id" => $paymentId],
            $newPayment
        )
    );
}

redirect("/admin/reservations");
