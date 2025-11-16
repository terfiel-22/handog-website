<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Enums\PaymentStatus;
use Http\Enums\YesNo;
use Http\Helpers\PaymentHelper;
use Http\Helpers\ReservationHelper;
use Http\Models\Payment;
use Http\Services\PDFService;

if (!isset($_GET["payment_link"])) {
    redirect("/booking");
    die();
}

$payment_link = $_GET["payment_link"];
$payment = App::resolve(PaymentHelper::class)->retrievePaymentLink($payment_link);

if ($payment["success"] == YesNo::YES) {
    // Update Saved Payment On Database
    if ($payment["payment_status"] == PaymentStatus::PAID) {
        $savedPayment = App::resolve(Payment::class)->retrievePaymentByPaymentLink($payment_link);
        if ($savedPayment["payment_status"] != PaymentStatus::UNPAID) {
            $updatedPayment = [
                "id" => $savedPayment["id"],
                "amount" => $payment["amount"],
                "payment_method" => $payment["payment_method"],
                "payment_status" => PaymentStatus::PAID,
            ];
            App::resolve(Payment::class)->updatePayment($updatedPayment);
            $attachmentPath = PDFService::generatePDF($savedPayment["reservation_id"]);
            App::resolve(ReservationHelper::class)->sendEmailForBookingConfirmation($savedPayment["contact_person"], $savedPayment["check_in"], $savedPayment["check_out"], $savedPayment["contact_email"], $attachmentPath);
            App::resolve(FileUploadHandler::class)->deleteFile($attachmentPath);
        }
    }
}


view(
    "guest/booking/show.view.php",
    compact('payment')
);
