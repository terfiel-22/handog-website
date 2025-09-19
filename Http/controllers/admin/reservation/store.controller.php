<?php

use Core\App;
use Http\Models\Facility;

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();

view(
    "admin/reservation/store.view.php",
    compact('facilities')
);
