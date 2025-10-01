<?php

use Core\App;
use Http\Models\Facility;

$facilities = App::resolve(Facility::class)->fetchFacilities();

view(
    "guest/booking/create.view.php",
    compact('facilities')
);
