<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Rates;
use Http\Models\Reservation;

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();
$rates = App::resolve(Rates::class)->fetchRates();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);

view(
    "admin/reservation/create.view.php",
    compact('facilities', 'bookings', 'rates', 'errors')
);
