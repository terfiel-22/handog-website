<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Rates;
use Http\Models\Reservation;

$rates = App::resolve(Rates::class)->fetchRates();
$facilities = App::resolve(Facility::class)->fetchFacilities();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);
$promos = App::resolve(Promo::class)->fetchOngoingPromos();
$filepath = "assets/default/sample-terms-conditions-agreement.pdf";
$terms['file'] = handleFilePath($filepath);

view(
    "guest/booking/create.view.php",
    compact('facilities', 'bookings', 'rates', 'promos', 'terms', 'errors')
);
