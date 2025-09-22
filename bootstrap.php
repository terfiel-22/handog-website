<?php

use Core\App;
use Core\Container;
use Core\Database;
use Http\Models\EntranceRates;
use Http\Models\Facility;
use Http\Models\Rates;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;

$container = new Container();

/** Add all key(class name) value(resolver/function for class initialization) pair */
$container->bind(Database::class, function () {
    $config = require base_path("config.php");
    return new Database($config['database']);
});

/** Models */
$container->bind(Facility::class, function () {
    return new Facility();
});
$container->bind(Reservation::class, function () {
    return new Reservation();
});
$container->bind(ReservationGuest::class, function () {
    return new ReservationGuest();
});
$container->bind(Rates::class, function () {
    return new Rates();
});
$container->bind(EntranceRates::class, function () {
    return new EntranceRates();
});

App::setContainer($container);
