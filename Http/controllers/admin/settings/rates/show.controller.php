<?php

use Core\Session;
use Http\Services\RatesService;

$rates = RatesService::getRates();
$errors = Session::get('errors', []);

view(
    "admin/settings/rates/show.view.php",
    compact('rates', 'errors')
);
