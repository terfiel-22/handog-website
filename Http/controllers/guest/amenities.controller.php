<?php

use Core\App;
use Http\Enums\AmenityType;
use Http\Models\Amenity;

$pools = App::resolve(Amenity::class)->fetchAmenitiesByType(AmenityType::POOL);
$griller = App::resolve(Amenity::class)->fetchSingleAmenityWithImagesByType(AmenityType::GRILLER);
$shower = App::resolve(Amenity::class)->fetchSingleAmenityWithImagesByType(AmenityType::SHOWER_ROOM);

view(
    "guest/amenities.view.php",
    compact('pools', 'griller', 'shower')
);
