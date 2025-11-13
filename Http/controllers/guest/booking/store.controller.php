<?php

use Core\App;
use Http\Enums\PaymentStatus;
use Http\Enums\PaymentType;
use Http\Enums\ReservationStatus;
use Http\Enums\YesNo;
use Http\Forms\BookingForm;
use Http\Helpers\PaymentHelper;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Models\Reservation;

$bookingForm = BookingForm::validate($_POST);

$facilityRate = App::resolve(ReservationHelper::class)->getFacilityRate($_POST["time_range"], $_POST['facility']);

$total_price = App::resolve(ReservationHelper::class)->getReservationTotalPrice($facilityRate, $_POST);
$bookingDeposit = bookingDeposit($total_price);
$amountToPay = (float) $_POST["amount_to_pay"];
if ($amountToPay < $bookingDeposit || $amountToPay > $total_price) {
    $bookingForm->error(
        "amount_to_pay",
        "Amount to pay should be at range $bookingDeposit - $total_price."
    )->throw();
}

$paymentLink = App::resolve(PaymentHelper::class)->createPaymentLink($amountToPay);
if ($paymentLink["success"] == YesNo::NO) {
    $bookingForm->error(
        "total_rate",
        $paymentLink["error"]
    )->throw();
}

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
    "status" => ReservationStatus::PENDING
];

$reservationId = App::resolve(Reservation::class)->createReservation($reservation);

App::resolve(ReservationHelper::class)->addGuestList($reservationId, $_POST["guests"]);

$payment = [
    "reservation_id" => $reservationId,
    "amount" => $amountToPay,
    "payment_method" => NULL,
    "payment_status" => PaymentStatus::UNPAID,
    "payment_type" => PaymentType::DEPOSIT,
    "payment_link" => $paymentLink["id"],
];
App::resolve(Payment::class)->createPayment($payment);

redirect("/booking/show?payment_link=" . $paymentLink["id"]);
