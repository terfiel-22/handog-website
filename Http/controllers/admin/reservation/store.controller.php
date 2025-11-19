<?php

use Core\App;
use Http\Enums\AuditAction;
use Http\Enums\AuditModule;
use Http\Enums\PaymentMethod;
use Http\Enums\PaymentType;
use Http\Enums\ReservationStatus;
use Http\Forms\ReservationForm;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Models\Reservation;
use Http\Services\AuditTrailService;
use Http\Services\RatesService;
use Http\Services\UserService;

ReservationForm::validate($_POST);

$facilityRate = RatesService::getFacilityRate($_POST["time_range"], $_POST['facility']);
$discountedValue = RatesService::getCurrentDiscountOnFacility($_POST['facility'], $facilityRate);
$total_price = RatesService::getReservationTotalPrice($_POST);
$check_out = App::resolve(ReservationHelper::class)->calculateCheckOut($_POST["check_in"], $_POST["time_range"]);
$guests = $_POST["guests"] ?? [];
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
    "discounted_value" => $discountedValue,
    "guest_count" => count($guests),
    "total_price" => $total_price,
    "status" => ReservationStatus::CONFIRMED
];

$reservationId = App::resolve(Reservation::class)->createReservation($reservation);

foreach ($guests as $i => $guest) {
    $guests[$i]["presented_id"] = null;
}
App::resolve(ReservationHelper::class)->addGuestList($reservationId, $guests);

/** Set payment */
$payment = [
    "reservation_id" => $reservationId,
    "amount" => $total_price,
    "payment_method" => PaymentMethod::CASH,
    "payment_type" => PaymentType::FULL,
    "payment_status" => $_POST["payment_status"],
    "payment_link" => NULL,
];


$paymentId = App::resolve(Payment::class)->createPayment($payment);

/** Audit Log */
$user = UserService::getCurrentUser();
AuditTrailService::audit_log(
    $user["id"],
    AuditAction::PAYMENT_CREATED,
    AuditModule::PAYMENT,
    null,
    array_merge(
        $payment,
        ["id" => $paymentId],
    )
);

redirect("/admin/reservations");
