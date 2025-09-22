<?php

use Core\App;
use Http\Models\Rates;

$rates = App::resolve(Rates::class)->fetchRates();

view(
    "admin/settings/rates/show.view.php",
    compact('rates')
);
