<?php

use Core\App;
use Http\Helpers\PaymentHelper;

$payment = App::resolve(PaymentHelper::class)->retrievePaymentLink($_GET["payment_id"]);
// dd($payment);

view(
    "guest/booking/show.view.php",
    compact('payment')
);
