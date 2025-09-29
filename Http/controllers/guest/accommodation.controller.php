<?php

use Core\App;
use Http\Enums\FacilityType;
use Http\Models\Facility;

$rooms = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::ROOM);
$cottages = App::resolve(Facility::class)->fetchFacilitiesByType(FacilityType::COTTAGE);
$eventHall = App::resolve(Facility::class)->fetchSingleFacilityWithImagesByType(FacilityType::EVENT_HALL);
$exclusive = App::resolve(Facility::class)->fetchSingleFacilityWithImagesByType(FacilityType::EXCLUSIVE);

view(
    "guest/accommodation.view.php",
    compact('rooms', 'cottages', 'eventHall', 'exclusive')
);
