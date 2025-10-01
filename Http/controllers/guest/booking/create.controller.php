<?php

use Core\App;
use Http\Models\Facility;
use Http\Models\Rates;

$rates = App::resolve(Rates::class)->fetchRates();
$facilities = App::resolve(Facility::class)->fetchFacilities();

view(
    "guest/booking/create.view.php",
    compact('facilities', 'rates')
);
