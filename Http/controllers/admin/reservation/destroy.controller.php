<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;

$reservation = App::resolve(Reservation::class)->fetchReservationById($_POST["item_id"]);

$reservationGuests = App::resolve(ReservationGuest::class)->fetchGuestsByReservationId($reservation["id"]);

// Delete uploaded IDs
foreach ($reservationGuests as $guest) {
    if (isset($guest["presented_id"])) {
        App::resolve(FileUploadHandler::class)->deleteFile($guest["presented_id"]);
    }
}

App::resolve(Reservation::class)->deleteReservation($reservation["id"]);

redirect("/admin/reservations");
