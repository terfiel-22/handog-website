<?php

use Core\App;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;

$id = $_GET["id"] ?? 0;

$reservation = App::resolve(Reservation::class)->fetchReservationById($id);
$guests = App::resolve(ReservationGuest::class)->fetchGuestsByReservationId($id);

view(
    "admin/reservation/show.view.php",
    compact('reservation', 'guests')
);
