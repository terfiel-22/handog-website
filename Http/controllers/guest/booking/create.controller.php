<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Rates;
use Http\Models\Reservation;

$rates = App::resolve(Rates::class)->fetchRates();
$facilities = App::resolve(Facility::class)->fetchFacilities();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);

view(
    "guest/booking/create.view.php",
    compact('facilities', 'bookings', 'rates', 'errors')
);
