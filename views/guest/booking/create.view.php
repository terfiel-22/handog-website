<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Booking"
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

    <!-- Booking Form -->
    <section class="gt-contacts-section section-padding fix">
        <div class="container">
            <div class="gt-contact-wrapper">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="gt-contact-right-items">
                            <h2>
                                Book a reservation
                            </h2>
                            <p>Complete filling up the form to continue.</p>
                            <form action="#" id="contact-form" class="booking">
                                <div class="form-block">
                                    <h4 class="fw-bold">Booking Information</h4>
                                    <div class="row g-4 align-items-center">
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="check_in">Check In</label>
                                            <div class="form-clt">
                                                <input type="text" name="check_in" id="check_in" value="<?= $_GET["check_in"] ?? date("d/m/Y H:i") ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                                            <label for="check_out">Check Out</label>
                                            <div class="form-clt">
                                                <input type="text" name="check_out" id="check_out" value="<?= $_GET["check_out"] ?? date("d/m/Y H:i") ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="facility_id">Facility</label>
                                            <div class="form-clt">
                                                <select name="facility_id" id="facility_id" class="single-select w-100">
                                                    <option hidden>Facility</option>
                                                    <?php foreach ($facilities as $facility): ?>
                                                        <option value="<?= $facility['id'] ?>" data-rate-8hrs="<?= $facility['rate_8hrs'] ?>" data-rate-12hrs="<?= $facility['rate_12hrs'] ?>" data-rate-1day="<?= $facility['rate_1day'] ?>" <?= ($_GET["facility_id"] ?? 0) == $facility["id"] ? "selected" : "" ?>><?= $facility['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="guest_count">Guest Count</label>
                                            <div class="form-clt">
                                                <input type="number" name="guest_count" id="guest_count" placeholder="Guest Count" value="<?= $_GET["guest_count"] ?? "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-block">
                                    <h4 class="fw-bold">Contact Information</h4>
                                    <div class="row g-4 align-items-center">
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="contact_person">Full Name</label>
                                            <div class="form-clt">
                                                <input type="text" name="contact_person" id="contact_person" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                                            <label for="contact_email">Email</label>
                                            <div class="form-clt">
                                                <input type="email" name="contact_email" id="contact_email" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="contact_no">Phone Number</label>
                                            <div class="form-clt">
                                                <input type="tel" name="contact_no" id="contact_no" placeholder="Your Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="contact_address">Address</label>
                                            <div class="form-clt">
                                                <input type="text" name="contact_address" id="contact_address" placeholder="Your Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="gt-theme-btn mt-2">PROCEED</button>
                            </form>
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

    <!-- Date picker -->
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