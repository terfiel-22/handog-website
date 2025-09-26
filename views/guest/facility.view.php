<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Room Details"
]) ?>

<body>
    <!-- Preloader Start -->
    <?php view("guest/partials/preloader.partial.php") ?>

    <!-- Misc Section -->
    <?php view("guest/partials/misc.partial.php") ?>

    <!-- Offcanvas Area Start -->
    <?php view("guest/partials/off_canvas.partial.php") ?>

    <!-- Header Section Start -->
    <?php view("guest/partials/header.partial.php") ?>

    <!-- GT Room Details Section Start -->
    <section class="gt-room-details section section-padding">
        <div class="container">
            <div class="gt-room-details-wrapper">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="gt-room-items">
                            <div class="room-image">
                                <img src="<?= $facility["image"] ?? "/assets/guest/img/room-details-img.jpg" ?>" alt="img">
                            </div>
                            <div class="gt-room-content">
                                <h2><?= $facility["name"] ?></h2>
                                <p>
                                    <?= $facility["description"] ?>
                                </p>

                                <div class="gt-list-content mb-0 pb-0">
                                    <h3><?= ucfirst($facility["type"]) ?> Information:</h3>
                                    <ul>
                                        <li>
                                            <span>
                                                <i class="fa-solid fa-circle-check"></i>
                                                Availability:
                                            </span>
                                            <?= ucfirst($facility["status"]) ?>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa-solid fa-circle-check"></i>
                                                Price:
                                            </span>
                                            <?= ($facility['rate_hourly'] > 0) ? moneyFormat($facility['rate_hourly']) . " / hour</br>" : "" ?>
                                            <?= ($facility['rate_8hrs'] > 0) ? moneyFormat($facility['rate_8hrs']) . " / 8-hours</br>" : "" ?>
                                            <?= ($facility['rate_12hrs'] > 0) ? moneyFormat($facility['rate_12hrs']) . " / 12-hours</br>" : "" ?>
                                            <?= ($facility['rate_1day'] > 0) ? moneyFormat($facility['rate_1day']) . " / 1 day" : "" ?>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa-solid fa-circle-check"></i>
                                                Amenities:
                                            </span>
                                            <?= $facility["amenities"] ?>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa-solid fa-circle-check"></i>
                                                Cancellation Policy:
                                            </span>
                                            Cancellations are generally not allowed.
                                            Exceptions apply in cases of force majeure such as typhoons, natural disasters, or emergencies. In such cases, bookings are automatically canceled without penalty.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="gt-main-sideber">
                            <div class="gt-single-sideber-widget">
                                <div class="gt-widget-title">
                                    <h3>Hotel Booking</h3>
                                </div>
                                <div class="booking-item">
                                    <form action="#">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <input type="text" placeholder="Check In">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <input type="text" placeholder="Check Out">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <div class="form">
                                                        <select class="single-select w-100">
                                                            <option>Room</option>
                                                            <option>01</option>
                                                            <option>02</option>
                                                            <option>03</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <div class="form">
                                                        <select class="single-select w-100">
                                                            <option>Guest</option>
                                                            <option>01</option>
                                                            <option>02</option>
                                                            <option>03</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="gt-theme-btn w-100" type="submit">
                                                    CHECK AVAILABILITY
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>
</body>

</html>