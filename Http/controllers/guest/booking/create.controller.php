<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Rates;

$rates = App::resolve(Rates::class)->fetchRates();
$facilities = App::resolve(Facility::class)->fetchFacilities();
$errors = Session::get('errors', []);

view(
    "guest/booking/create.view.php",
    compact('facilities', 'rates', 'errors')
);
