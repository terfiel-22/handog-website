<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\FileUploadHandler;
use Http\Models\Facility;
use Http\Models\FacilityImage;
use Http\Models\FacilityRates;
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
$container->bind(FacilityImage::class, function () {
    return new FacilityImage();
});
$container->bind(FacilityRates::class, function () {
    return new FacilityRates();
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

/** Handler */
$container->bind(FileUploadHandler::class, function () {
    return new FileUploadHandler();
});


App::setContainer($container);
