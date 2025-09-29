<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\FileUploadHandler;
use Http\Helpers\ReservationHelper;
use Http\Models\Amenity;
use Http\Models\AmenityImage;
use Http\Models\Facility;
use Http\Models\FacilityImage;
use Http\Models\GalleryImage;
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
$container->bind(Amenity::class, function () {
    return new Amenity();
});
$container->bind(AmenityImage::class, function () {
    return new AmenityImage();
});
$container->bind(GalleryImage::class, function () {
    return new GalleryImage();
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

/** Helpers */
$container->bind(ReservationHelper::class, function () {
    return new ReservationHelper();
});


App::setContainer($container);
