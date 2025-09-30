<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Rates;

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();
$rates = App::resolve(Rates::class)->fetchRates();
$errors = Session::get('errors', []);

view(
    "admin/reservation/create.view.php",
    compact('facilities', 'rates', 'errors')
);
