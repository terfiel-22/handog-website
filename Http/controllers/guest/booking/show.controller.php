<?php

use Core\App;
use Http\Helpers\PaymentHelper;

$title = "Booking Complete!";
$subtitle = "Thank you for choosing us! Your payment went through, and we can't wait to welcome you soon.";

$payment = App::resolve(PaymentHelper::class)->createPaymentLink($total_price);
$paymentLink = App::resolve(PaymentHelper::class)->retrievePaymentLink($payment["id"]);
dd($paymentLink);

view(
    "guest/booking/show.view.php",
    compact('title', 'subtitle')
);
