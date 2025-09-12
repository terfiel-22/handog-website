<?php

use Core\App;
use Http\Models\Facility;

$facilities = App::resolve(Facility::class)->fetchFacilities();

view(
    "admin/facility/index.view.php",
    compact('facilities')
);
