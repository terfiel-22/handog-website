<?php

use Core\App;
use Http\Models\Reservation;

$reservation = App::resolve(Reservation::class)->fetchReservationById($_POST["item_id"]);

App::resolve(Reservation::class)->deleteReservation($reservation["id"]);

redirect("/admin/reservations");
