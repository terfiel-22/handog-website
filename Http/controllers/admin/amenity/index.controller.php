<?php

use Core\App;
use Http\Models\Amenity;

$amenities = App::resolve(Amenity::class)->fetchAmenities();

view(
    "admin/amenity/index.view.php",
    compact('amenities')
);
