<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Enums\AuditAction;
use Http\Enums\AuditModule;
use Http\Enums\PaymentStatus;
use Http\Enums\PaymentType;
use Http\Enums\ReservationStatus;
use Http\Enums\YesNo;
use Http\Forms\BookingForm;
use Http\Helpers\PaymentHelper;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Models\Reservation;
use Http\Services\AuditTrailService;
use Http\Services\RatesService;

$bookingForm = BookingForm::validate($_POST);

// --- START Validation for Senior/PWD ID:  
$guests = $_POST["guests"] ?? [];
$files = $_FILES;
foreach ($guests as $i => $guest) {
    $isSenior = isset($guest["senior_pwd"]) && $guest["senior_pwd"] === YesNo::YES;
    // File info for this guest
    $fileName  = $files["presented_id_$i"]["name"] ?? null;
    $fileError = $files["presented_id_$i"]["error"] ?? 4; // 4 = no file uploaded

    $hasFile = ($fileError === 0 && !empty($fileName));

    // RULE 1: Senior/PWD = yes but NO file uploaded
    if ($isSenior && !$hasFile) {
        $bookingForm->error(
            "guests",
            $guests[$i]["guest_name"] . " marked as Senior/PWD but no ID was uploaded."
        )->throw();
    }

    // RULE 2: Senior/PWD = no but file WAS uploaded
    if (!$isSenior && $hasFile) {
        $bookingForm->error(
            "guests",
            $guests[$i]["guest_name"] . " uploaded an ID but is NOT marked as Senior/PWD."
        )->throw();
    }
}
// --- END Validation for Senior/PWD ID:

$facilityRate = RatesService::getFacilityRate($_POST["time_range"], $_POST['facility']);
if ((int)$facilityRate < 1) {
    $bookingForm->error(
        "time_range",
        "The time range you selected is unavailable at the moment."
    )->throw();
}
$discountedValue = RatesService::getCurrentDiscountOnFacility($_POST['facility'], $facilityRate);
$total_price = RatesService::getReservationTotalPrice($_POST);
$bookingDeposit = RatesService::bookingDeposit($total_price);

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
    "discounted_value" => $discountedValue,
    "guest_count" => count($guests),
    "total_price" => $total_price,
    "status" => ReservationStatus::PENDING
];

$reservationId = App::resolve(Reservation::class)->createReservation($reservation);

/** Audit Log */
AuditTrailService::audit_log(
    null,
    AuditAction::RESERVATION_CREATED,
    AuditModule::RESERVATION,
    null,
    array_merge(["id" => $reservationId], $reservation),
);

/** Upload Senior/PWD IDs */
foreach ($guests as $i => $guest) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->singleFile($files["presented_id_$i"]);
    if (!$fileuploadResult['success']) {
        $guests[$i]["presented_id"] = null;
        continue;
    }
    $guests[$i]["presented_id"] = $fileuploadResult['path'];
}
App::resolve(ReservationHelper::class)->addGuestList($reservationId, $guests);

$payment = [
    "reservation_id" => $reservationId,
    "amount" => $amountToPay,
    "payment_method" => NULL,
    "payment_status" => PaymentStatus::UNPAID,
    "payment_type" => PaymentType::DEPOSIT,
    "payment_link" => $paymentLink["id"],
];
$paymentId = App::resolve(Payment::class)->createPayment($payment);

/** Audit Log */
AuditTrailService::audit_log(
    null,
    AuditAction::PAYMENT_CREATED,
    AuditModule::PAYMENT,
    null,
    array_merge(["id" => $paymentId], $payment),
);

redirect("/booking/show?payment_link=" . $paymentLink["id"]);
