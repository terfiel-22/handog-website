<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Rates;
use Http\Models\Reservation;
use Http\Models\TermsConditions;

$rates = App::resolve(Rates::class)->fetchRates();
$facilities = App::resolve(Facility::class)->fetchFacilities();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);
$promos = App::resolve(Promo::class)->fetchOngoingPromos();

$terms = App::resolve(TermsConditions::class)->fetchTermsConditions();
if (!$terms) {
    $terms['filepath'] = handleFilePath(TERMS_CONDITIONS_PATH);
    $terms['id'] = null;
}

view(
    "guest/booking/create.view.php",
    compact('facilities', 'bookings', 'rates', 'promos', 'terms', 'errors')
);
