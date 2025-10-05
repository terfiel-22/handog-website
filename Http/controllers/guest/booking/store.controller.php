<?php

use Core\App;
use Http\Enums\PaymentMethod;
use Http\Enums\ReservationStatus;
use Http\Forms\BookingForm;
use Http\Helpers\PaymentHelper;
use Http\Helpers\ReservationHelper;
use Http\Models\Reservation;

BookingForm::validate($_POST);

$facilityRate = App::resolve(ReservationHelper::class)->getFacilityRate($_POST["time_range"], $_POST['facility']);
$total_price = App::resolve(ReservationHelper::class)->getReservationTotalPrice($facilityRate, $_POST);
$check_out = App::resolve(ReservationHelper::class)->calculateCheckOut($_POST["check_in"], $_POST["time_range"]);

// Create Payment Method
$paymentMethod = $_POST["payment_method"];
$cardDetails = [
    'card_number' => $_POST["card_number"] ?? '',
    'exp_month'   => isset($_POST["exp_month"]) ? (int) $_POST["exp_month"] : 0,
    'exp_year'    => isset($_POST["exp_year"]) ? (int) $_POST["exp_year"] : 0,
    'cvc'         => $_POST["cvc"] ?? '',
];

// Attach
$returnUrl = $_SERVER["HTTP_ORIGIN"] . "/booking/show";
$attachedPaymentIntent = App::resolve(PaymentHelper::class)->createPaymentIntent($total_price)->createPaymentMethod($paymentMethod, $cardDetails)->attachPaymentIntent($returnUrl);

if ($paymentMethod != PaymentMethod::CARD) {
    $redirectUrl = $attachedPaymentIntent->attributes->next_action->redirect->url;
    header("Location: $redirectUrl");
}

dd($attachedPaymentIntent);

$reservation = [
    "facility_id" => $_POST["facility"],
    "contact_person" => $_POST["contact_person"],
    "contact_no" => $_POST["contact_no"],
    "contact_email" => $_POST["contact_email"],
    "contact_address" => $_POST["contact_address"],
    "check_in" => $_POST["check_in"],
    "check_out" => $check_out,
    "rent_videoke" => $_POST["rent_videoke"],
    "guest_count" => count($_POST["guests"]),
    "total_price" => $total_price,
    "status" => ReservationStatus::PENDING
];

$reservationId = App::resolve(Reservation::class)->createReservation($reservation);

App::resolve(ReservationHelper::class)->addGuestList($reservationId, $_POST["guests"]);

// TODO: GO TO PAYMENT
dd($reservation);
