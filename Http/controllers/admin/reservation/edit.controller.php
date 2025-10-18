<?php

use Core\App;
use Core\Session;
use Http\Models\Facility;
use Http\Models\Rates;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;

$id = $_GET["id"] ?? 0;

$reservation = App::resolve(Reservation::class)->fetchPaidReservationById($id);
$guests = App::resolve(ReservationGuest::class)->fetchGuestsByReservationId($id);

$facilities = App::resolve(Facility::class)->fetchAvailableFacilities();
$rates = App::resolve(Rates::class)->fetchRates();
$errors = Session::get('errors', []);
$uncompleteReservations = App::resolve(Reservation::class)->uncompleteReservations();
$filtered = array_filter($uncompleteReservations, fn($res) => $res['id'] != $id);
$bookings = convertToBookingsFormat($filtered);

view(
    "admin/reservation/edit.view.php",
    compact('reservation', 'guests', 'facilities', 'bookings', 'rates', 'errors')
);
