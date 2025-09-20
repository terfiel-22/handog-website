<?php

use Core\App;
use Http\Models\Reservation;

$reservations = App::resolve(Reservation::class)->fetchReservations();

view(
    "admin/reservation/index.view.php",
    compact('reservations')
);
