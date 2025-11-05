<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\FileUploadHandler;
use Http\Helpers\ContactHelper;
use Http\Helpers\EmailHelper;
use Http\Helpers\PaymentHelper;
use Http\Helpers\ReservationHelper;
use Http\Models\Amenity;
use Http\Models\AmenityImage;
use Http\Models\Event;
use Http\Models\Facility;
use Http\Models\FacilityImage;
use Http\Models\Faq;
use Http\Models\GalleryImage;
use Http\Models\Logo;
use Http\Models\Payment;
use Http\Models\Promo;
use Http\Models\PromoFacility;
use Http\Models\Rates;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;
use Http\Models\TermsConditions;
use Http\Models\Testimonial;
use Http\Models\User;

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
$container->bind(Event::class, function () {
    return new Event();
});
$container->bind(Event::class, function () {
    return new Event();
});
$container->bind(Faq::class, function () {
    return new Faq();
});
$container->bind(Reservation::class, function () {
    return new Reservation();
});
$container->bind(ReservationGuest::class, function () {
    return new ReservationGuest();
});
$container->bind(Promo::class, function () {
    return new Promo();
});
$container->bind(PromoFacility::class, function () {
    return new PromoFacility();
});
$container->bind(Payment::class, function () {
    return new Payment();
});
$container->bind(User::class, function () {
    return new User();
});
$container->bind(Rates::class, function () {
    return new Rates();
});
$container->bind(Logo::class, function () {
    return new Logo();
});
$container->bind(TermsConditions::class, function () {
    return new TermsConditions();
});
$container->bind(Testimonial::class, function () {
    return new Testimonial();
});

/** Handler */
$container->bind(FileUploadHandler::class, function () {
    return new FileUploadHandler();
});

/** Helpers */
$container->bind(ReservationHelper::class, function () {
    return new ReservationHelper();
});
$container->bind(PaymentHelper::class, function () {
    $config = require base_path("config.php");
    return new PaymentHelper($config["paymongo"]);
});
$container->bind(EmailHelper::class, function () {
    $config = require base_path("config.php");
    return new EmailHelper($config["php_mailer"]);
});
$container->bind(ContactHelper::class, function () {
    $config = require base_path("config.php");
    return new ContactHelper($config["owner"]);
});

App::setContainer($container);
