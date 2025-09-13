<?php

use Core\App;
use Http\Enums\FacilityType;
use Http\Models\Facility;

$rooms = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::ROOM);

view(
    "guest/accommodation.view.php",
    compact('rooms')
);
