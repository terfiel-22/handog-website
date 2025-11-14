<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Promo;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;
use Http\Services\RatesService;

$id = $_GET["id"] ?? 0;

$reservation = App::resolve(Reservation::class)->fetchReservationById($id);

$guests = App::resolve(ReservationGuest::class)->fetchGuestsByReservationId($id);

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();
$rates = RatesService::getRates();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$filtered = array_filter($uncompleteReservations, fn($res) => $res['id'] != $id);
$bookings = convertToBookingsFormat($filtered);
$promos = App::resolve(Promo::class)->fetchOngoingPromos();

view(
    "admin/reservation/edit.view.php",
    compact('reservation', 'guests', 'facilities', 'bookings', 'rates', 'promos', 'errors')
);
