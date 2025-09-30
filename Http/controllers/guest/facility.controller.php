<?php

use Core\App;
use Http\Models\Facility;

$facilityId = $_GET['id'] ?? 0;
$facility = App::resolve(Facility::class)->fetchFacilityById($facilityId);
$facilities = App::resolve(Facility::class)->fetchFacilities();
view(
    "guest/facility.view.php",
    compact('facility', 'facilities')
);
