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
                            <form action="/booking/store" method="POST" class="booking">
                                <input type="hidden" name="time_slot" id="time_slot">
                                <!-- Booking Information -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Booking Information</h4>
                                    <div class="row g-4">
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="check_in">Check In</label>
                                            <div class="form-clt">
                                                <input type="text" name="check_in" id="check_in" value="<?= old("check_in", ($_GET["check_in"] ?? date("d/m/Y H:i"))) ?>">
                                                <?php if (isset($errors["check_in"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["check_in"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="facility">Hours Stay</label>
                                            <div class="form-clt">
                                                <select name="time_range" id="time_range" class="single-select w-100" required>
                                                    <?php foreach (\Http\Enums\ReservationTimeRange::toArray() as $time_range): ?>
                                                        <option value="<?= $time_range ?>" <?= ($_GET["time_range"] ?? \Http\Enums\ReservationTimeRange::RESERVE_8HRS) == $time_range ? "selected" : "" ?>><?= ucfirst($time_range) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if (isset($errors["time_range"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["time_range"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="facility">Facility</label>
                                            <div class="form-clt">
                                                <select name="facility" id="facility" class="single-select w-100">
                                                    <?php foreach ($facilities as $facility): ?>
                                                        <option value="<?= $facility['id'] ?>" data-rate-8hrs="<?= $facility['rate_8hrs'] ?>" data-rate-12hrs="<?= $facility['rate_12hrs'] ?>" data-rate-1day="<?= $facility['rate_1day'] ?>" <?= ($_GET["facility_id"] ?? 0) == $facility["id"] ? "selected" : "" ?>><?= $facility['name'] ?> (<?= ucfirst($facility['type']) ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if (isset($errors["facility"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["facility"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="guest_count">Guest Count</label>
                                            <div class="form-clt">
                                                <input type="number" name="guest_count" id="guest_count" placeholder="Guest Count" value="<?= $_GET["guest_count"] ?? 1 ?>" min="1">
                                                <?php if (isset($errors["guest_count"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["guest_count"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="rent_videoke">Rent Videoke?</label>
                                            <div class="form-clt">
                                                <select name="rent_videoke" id="rent_videoke" class="single-select w-100" required>
                                                    <?php foreach (\Http\Enums\YesNo::toArray() as $rent_videoke): ?>
                                                        <option value="<?= $rent_videoke ?>"><?= ucfirst($rent_videoke) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if (isset($errors["rent_videoke"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["rent_videoke"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Guest Information -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Guest Information</h4>
                                    <div id="guest-list" class="row g-4"></div>
                                </div>

                                <!-- Contact Information -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Contact Information</h4>
                                    <div class="row g-4">
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="contact_person">Full Name</label>
                                            <div class="form-clt">
                                                <input type="text" name="contact_person" id="contact_person" placeholder="Your Name" value="<?= old("contact_person") ?>">
                                                <?php if (isset($errors["contact_person"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["contact_person"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                                            <label for="contact_email">Email</label>
                                            <div class="form-clt">
                                                <input type="email" name="contact_email" id="contact_email" placeholder="Your Email" value="<?= old("contact_email") ?>">
                                                <?php if (isset($errors["contact_email"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["contact_email"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="contact_no">Phone Number</label>
                                            <div class="form-clt">
                                                <input type="tel" name="contact_no" id="contact_no" placeholder="Your Phone Number" value="<?= old("contact_no") ?>">
                                                <?php if (isset($errors["contact_no"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["contact_no"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="contact_address">Address</label>
                                            <div class="form-clt">
                                                <input type="text" name="contact_address" id="contact_address" placeholder="Your Address" value="<?= old("contact_address") ?>">
                                                <?php if (isset($errors["contact_address"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["contact_address"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Contact Information -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Payment Information</h4>
                                    <div class="row g-4">
                                        <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="total_rate">Total</label>
                                            <div class="form-clt">
                                                <input type="number" name="total_rate" id="total_rate" disabled>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="payment_method">Payment Method</label>
                                            <div class="form-clt">
                                                <select name="payment_method" id="payment_method" class="single-select w-100" required>
                                                    <?php foreach (\Http\Constants\PaymongoPayment::METHODS as $payment_method_key => $payment_method_label): ?>
                                                        <option value="<?= $payment_method_key ?>"><?= ucfirst($payment_method_label) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if (isset($errors["payment_method"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["payment_method"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-4 mt-2" id="card-fields"></div>
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
                dateFormat: "Y-m-d H:i",
            });
        }
        getDatePicker("#check_in");
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
                                <input type="text" name="guests[${i}][guest_name]" id="guests[${i}][guest_name]" placeholder="Guest Name" required>
                            </div>
                        </div> 
                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s"> 
                            <label for"guests[${i}][guest_age]">Guest ${i} Age</label>
                            <div class="form-clt">
                                <input type="number" name="guests[${i}][guest_age]" id="guests[${i}][guest_age]" placeholder="Guest Age" required>
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

    <!-- Generate Card Details Fields -->
    <script>
        $(document).ready(function() {
            $('#payment_method').on('change', function() {
                let selected = $(this).val();
                let cardFields = $('#card-fields');

                cardFields.empty(); // clear old fields

                if (selected === 'card') {
                    cardFields.append(`
                                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="card_number">Card Number</label>
                                            <div class="form-clt">
                                                <input type="text" name="card_number" id="card_number" value="<?= old("card_number") ?>">
                                                <?php if (isset($errors["card_number"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["card_number"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="exp_month">Expiration Month</label>
                                            <div class="form-clt">
                                                <input type="number" name="exp_month" id="exp_month" value="<?= old("exp_month") ?>">
                                                <?php if (isset($errors["exp_month"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["exp_month"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="exp_year">Expiration Year</label>
                                            <div class="form-clt">
                                                <input type="number" name="exp_year" id="exp_year" value="<?= old("exp_year") ?>">
                                                <?php if (isset($errors["exp_year"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["exp_year"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="cvc">CVC</label>
                                            <div class="form-clt">
                                                <input type="text" name="cvc" id="cvc" value="<?= old("cvc") ?>">
                                                <?php if (isset($errors["cvc"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["cvc"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
            `);
                }
            });
        });
    </script>

    <!-- Generate Total Rate -->
    <script>
        $(document).ready(function() {
            // Inject PHP rates
            const rates = <?= json_encode($rates) ?>;

            const isDaySlot = (checkIn) => {
                let checkDate = new Date(checkIn);
                if (isNaN(checkDate)) return null;

                let hour = checkDate.getHours();
                return hour >= 6 && hour < 18;
            }

            function computeTotal() {
                let total = 0;

                // --- Time range (8hrs/12hrs/1day) for getting facility rate ---
                const reservationTimeRanges = <?= json_encode(\Http\Enums\ReservationTimeRange::toArray()) ?>;
                const timeRange = $("#time_range").val() || reservationTimeRanges.RESERVE_8HRS;
                // --- Facility rate based on time_range ---
                let facilityRate = 0;
                if (timeRange === reservationTimeRanges.RESERVE_8HRS) {
                    facilityRate = parseFloat($("#facility option:selected").data("rate-8hrs")) || 0;
                } else if (timeRange === reservationTimeRanges.RESERVE_12HRS) {
                    facilityRate = parseFloat($("#facility option:selected").data("rate-12hrs")) || 0;
                } else if (timeRange === reservationTimeRanges.RESERVE_1DAY) {
                    facilityRate = parseFloat($("#facility option:selected").data("rate-1day")) || 0;
                }
                total += facilityRate;


                // --- Time slot (day/night) for per-guest computation ---
                const yesNo = <?= json_encode(\Http\Enums\YesNo::toArray()) ?>;
                const guestType = <?= json_encode(\Http\Enums\GuestType::toArray()) ?>;
                const timeSlots = <?= json_encode(\Http\Enums\TimeSlot::toArray()) ?>;
                const timeSlot = isDaySlot($("#check_in").val()) ? timeSlots.DAY : timeSlots.NIGHT;
                $("#time_slot").val(timeSlot);
                // --- Guest rates (adult/kid per day/night) ---
                $("#guest-list").find("[name*='[guest_type]']").each(function() {
                    const guestIndex = $(this).attr("name").match(/\d+/)[0]; // extract index
                    const type = $(`[name='guests[${guestIndex}][guest_type]']`).val();
                    const seniorPwd = $(`[name='guests[${guestIndex}][senior_pwd]']`).val();

                    let rate = 0;
                    if (type === guestType.ADULT) {
                        rate = parseFloat(rates[`adult_rate_${timeSlot}`]) || 0;
                    } else if (type === guestType.KID) {
                        rate = parseFloat(rates[`kid_rate_${timeSlot}`]) || 0;
                    }

                    if (seniorPwd === yesNo.YES) {
                        const discountPercent = parseFloat(rates.senior_pwd_discount) || 0;
                        const discount = rate * (discountPercent / 100);
                        rate -= discount;

                        // Prevent negative rate
                        if (rate < 0) {
                            rate = 0;
                        }
                    }

                    total += rate;
                });

                // --- Videoke rent ---
                if ($("#rent_videoke").val() === yesNo.YES) {
                    total += parseFloat(rates.videoke_rent) || 0;
                }

                // --- Display total ---
                $("#total_rate").val(total.toFixed(2));
            }

            // Recompute whenever form values change
            $(document).on("change input", "#time_range, #check_in, #rent_videoke, #facility, #guest-list select", computeTotal);

            // Initial compute
            computeTotal();
        });
    </script>
</body>

</html>