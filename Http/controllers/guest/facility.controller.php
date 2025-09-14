<?php

use Core\App;
use Http\Models\Facility;

$facilityId = $_GET['id'] ?? 0;
$facility = App::resolve(Facility::class)->fetchFacilityById($facilityId);

view(
    "guest/facility.view.php",
    compact('facility')
);
