<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Reservation;
use Http\Services\RatesService;
use Http\Services\SettingService;

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();
$rates = RatesService::getRates();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$bookings = convertToBookingsFormat($uncompleteReservations);
$promos = App::resolve(Promo::class)->fetchOngoingPromos();
$logo = handleFilePath(SettingService::getLogo()["logo"]);

view(
    "admin/reservation/create.view.php",
    compact('facilities', 'bookings', 'rates', 'promos', 'logo', 'errors')
);
