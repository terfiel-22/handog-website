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
                                    <form action="/book/info" method="POST">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <input type="text" id="check_in" name="check_in" placeholder="Check In">
                                                    <?php if (isset($errors["check_in"])) : ?>
                                                        <div class=" error-text">
                                                            <?= $errors["check_in"] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <input type="text" id="check_out" name="check_out" placeholder="Check Out">
                                                    <?php if (isset($errors["check_out"])) : ?>
                                                        <div class=" error-text">
                                                            <?= $errors["check_out"] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <div class="form">
                                                        <select name="facility_id" id="facility" class="single-select w-100">
                                                            <option hidden>Facility</option>
                                                            <?php foreach ($facilities as $facility): ?>
                                                                <option value="<?= $facility['id'] ?>" data-rate-8hrs="<?= $facility['rate_8hrs'] ?>" data-rate-12hrs="<?= $facility['rate_12hrs'] ?>" data-rate-1day="<?= $facility['rate_1day'] ?>" <?= $_GET["id"] == $facility["id"] ? "selected" : "" ?>><?= $facility['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?php if (isset($errors["facility"])) : ?>
                                                            <div class=" error-text">
                                                                <?= $errors["facility"] ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <div class="form">
                                                        <input type="number" id="guest_count" name="guest_count" placeholder="Guest Count">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="gt-theme-btn w-100" type="submit">
                                                    BOOK
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

    <script>
        // Flat pickr or date picker js
        function getDatePicker(receiveID) {
            flatpickr(receiveID, {
                enableTime: true,
                dateFormat: "d/m/Y H:i",
            });
        }
        getDatePicker("#check_in");
        getDatePicker("#check_out");
    </script>
</body>

</html>