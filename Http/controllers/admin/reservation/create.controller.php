<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();
$errors = Session::get('errors', []);

view(
    "admin/reservation/create.view.php",
    compact('facilities', 'errors')
);
