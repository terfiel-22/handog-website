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
                                <!-- Booking Information -->
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
                                                <input type="number" name="guest_count" id="guest_count" placeholder="Guest Count" value="<?= $_GET["guest_count"] ?? 1 ?>" min="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Guest Information -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Guest Information</h4>
                                    <div id="guest-list" class="row g-4 align-items-center"></div>
                                </div>

                                <!-- Contact Information -->
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


    <!-- Generate Guest Fields -->
    <script>
        $(document).ready(function() {
            const generateGuestFields = (count) => {
                let $container = $("#guest-list");
                $container.empty(); // clear old fields

                if (count > 0) {
                    for (let i = 1; i <= count; i++) {
                        let fieldGroup = `
                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s"> 
                            <label for"guests[${i}][guest_name]">Guest ${i} Name</label>
                            <div class="form-clt">
                                <input type="text" name="guests[${i}][guest_name]" id="guests[${i}][guest_name]" placeholder="Guest Name">
                            </div>
                        </div> 
                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s"> 
                            <label for"guests[${i}][guest_age]">Guest ${i} Age</label>
                            <div class="form-clt">
                                <input type="number" name="guests[${i}][guest_age]" id="guests[${i}][guest_age]" placeholder="Guest Age">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s">
                            <label for="guests[${i}][guest_type]">Type</label> 
                            <div class="form-clt">
                                <select name="guests[${i}][guest_type]" id="guests[${i}][guest_type]" class="single-select w-100">
                                    <?php foreach (\Http\Enums\GuestType::toArray() as $type): ?>
                                        <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s"> 
                            <label for="guests[${i}][senior_pwd]">Senior/PWD</label> 
                            <div class="form-clt">
                                <select name="guests[${i}][senior_pwd]" id="guests[${i}][senior_pwd]" class="single-select w-100"> 
                                    <?php foreach (\Http\Enums\YesNo::toArray() as $yesNo): ?>
                                        <option value="<?= $yesNo ?>"><?= ucfirst($yesNo) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> 
                        </div>
                        `;
                        $container.append(fieldGroup);
                    }
                }
            }
            $("#guest_count").on("input", function() {
                let guestCount = parseInt($(this).val()) || 1;
                generateGuestFields(guestCount);
            });
            // Generate atleast 1 guest field
            const guestCount = <?= $_GET["guest_count"] ?? 1 ?>;
            generateGuestFields(guestCount);
        });
    </script>
</body>

</html>