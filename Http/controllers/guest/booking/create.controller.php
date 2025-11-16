<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Reservation;
use Http\Models\TermsConditions;
use Http\Services\RatesService;
use Http\Services\SettingService;

$rates = RatesService::getRates();
$facilities = App::resolve(Facility::class)->fetchFacilities();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);
$promos = App::resolve(Promo::class)->fetchOngoingPromos();
$logo = handleFilePath(SettingService::getLogo()["logo"]);

$terms = App::resolve(TermsConditions::class)->fetchTermsConditions();
if (!$terms) {
    $terms['filepath'] = handleFilePath(TERMS_CONDITIONS_PATH);
    $terms['id'] = null;
} else {
    $terms['filepath'] = handleFilePath($terms['filepath']);
}

view(
    "guest/booking/create.view.php",
    compact('facilities', 'bookings', 'rates', 'promos', 'terms', 'logo', 'errors')
);
