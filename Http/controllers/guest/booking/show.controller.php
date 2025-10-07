<?php

use Core\App;
use Http\Helpers\PaymentHelper;

$title = "Booking Complete!";
$subtitle = "Thank you for choosing us! Your payment went through, and we can't wait to welcome you soon.";

$paymentLink = App::resolve(PaymentHelper::class)->retrievePaymentLink($_GET["payment_id"]);
dd($paymentLink);

view(
    "guest/booking/show.view.php",
    compact('title', 'subtitle')
);
