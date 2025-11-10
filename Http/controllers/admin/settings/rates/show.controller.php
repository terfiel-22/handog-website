<?php

use Core\App;
use Core\Session;
use Http\Models\Rates;

$rates = App::resolve(Rates::class)->fetchRates();
$errors = Session::get('errors', []);

view(
    "admin/settings/rates/show.view.php",
    compact('rates', 'errors')
);
