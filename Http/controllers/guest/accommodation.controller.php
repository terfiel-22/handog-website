<?php

use Core\App;
use Http\Enums\FacilityType;
use Http\Models\Facility;

$rooms = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::ROOM);
$cottages = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::COTTAGE);
$eventHalls = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::EVENT_HALL);
$exclusives = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::EXCLUSIVE);

view(
    "guest/accommodation.view.php",
    compact('rooms', 'cottages', 'eventHalls', 'exclusives')
);
