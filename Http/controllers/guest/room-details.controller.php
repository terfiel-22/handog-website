<?php

use Core\App;
use Http\Models\Facility;

$roomId = $_GET['id'] ?? 0;
$room = App::resolve(Facility::class)->fetchFacilityById($roomId);

view(
    "guest/room-details.view.php"
);
