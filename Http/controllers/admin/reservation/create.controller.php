<?php

use Core\App;
use Http\Models\Facility;

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();

view(
    "admin/reservation/create.view.php",
    compact('facilities')
);
