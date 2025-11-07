<?php

use Core\App;
use Http\Models\Facility;
use Http\Models\Reservation;

$facilityId = $_GET['id'] ?? 0;
$facility = App::resolve(Facility::class)->fetchFacilityById($facilityId);
$facilities = App::resolve(Facility::class)->fetchFacilities();

$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);

view(
    "guest/facility.view.php",
    compact('facility', 'facilities', 'bookings')
);
