<?php

use Core\App;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;
use Http\Services\SettingService;

$id = $_GET["id"] ?? 0;
$reservation = App::resolve(Reservation::class)->fetchReservationById($id);
$guests = App::resolve(ReservationGuest::class)->fetchGuestsByReservationId($id);
$logo = handleFilePath(SettingService::getLogo()["logo"]);

view(
    "templates/payment_receipt.view.php",
    compact('reservation', 'guests', 'logo')
);
