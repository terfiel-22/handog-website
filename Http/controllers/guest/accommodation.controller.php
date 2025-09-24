<?php

use Core\App;
use Http\Enums\FacilityType;
use Http\Models\Facility;

$rooms = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::ROOM);
$cottages = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::COTTAGE);

view(
    "guest/accommodation.view.php",
    compact('rooms', 'cottages')
);
