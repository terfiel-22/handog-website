<?php

use Core\App;
use Http\Constants\PaymongoPayment;
use Http\Enums\ReservationStatus;
use Http\Forms\BookingForm;
use Http\Helpers\PaymentHelper;
use Http\Helpers\ReservationHelper;
use Http\Models\Reservation;

BookingForm::validate($_POST);

$facilityRate = App::resolve(ReservationHelper::class)->getFacilityRate($_POST["time_range"], $_POST['facility']);
$total_price = App::resolve(ReservationHelper::class)->getReservationTotalPrice($facilityRate, $_POST);
$check_out = App::resolve(ReservationHelper::class)->calculateCheckOut($_POST["check_in"], $_POST["time_range"]);

// Create Payment Intent
$paymentIntentId = App::resolve(PaymentHelper::class)->createPaymentIntent($total_price);

// Create Payment Method
$paymentMethod = array_key_first(PaymongoPayment::METHODS); // gcash hardcoded
$paymentMethodId = App::resolve(PaymentHelper::class)->createPaymentMethod($paymentMethod);

// Attach
$returnUrl = $_SERVER["HTTP_ORIGIN"] . "/booking/success";
$redirectUrl = App::resolve(PaymentHelper::class)->attachPaymentIntent($paymentIntentId, $paymentMethodId, $returnUrl);

header("Location: $redirectUrl");
dd(compact('paymentIntentId', 'paymentMethodId'));

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
