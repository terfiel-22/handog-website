<?php

use Core\App;
use Http\Enums\AmenityType;
use Http\Models\Amenity;

$pools = App::resolve(Amenity::class)->fetchAmenitiesByType(AmenityType::POOL);

view(
    "guest/amenities.view.php",
    compact('pools')
);
