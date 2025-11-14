<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Reservation;
use Http\Services\RatesService;

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();
$rates = RatesService::getRates();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);
$promos = App::resolve(Promo::class)->fetchOngoingPromos();

view(
    "admin/reservation/create.view.php",
    compact('facilities', 'bookings', 'rates', 'promos', 'errors')
);
