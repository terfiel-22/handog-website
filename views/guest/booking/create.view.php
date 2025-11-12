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
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="card h-100 p-0">
                            <div class="card-body p-24">
                                <div id="wrap">
                                    <div id="calendar"></div>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gt-contact-right-items">
                            <h2>
                                Book a reservation
                            </h2>
                            <p>Complete filling up the form to continue.</p>
                            <div class="error-text" role="alert" id="check_in_msg"></div>
                            <form action="/booking/store" method="POST" class="booking" id="bookingForm">
                                <input type="hidden" name="time_slot" id="time_slot">
                                <!-- Booking Information -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Booking Information</h4>
                                    <div class="row g-4">
                                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s">
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
                                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="time_range">Hours Stay</label>
                                            <div class="form-clt">
                                                <select name="time_range" id="time_range" class="single-select w-100" required>
                                                    <?php foreach (\Http\Enums\ReservationTimeRange::toArray() as $time_range): ?>
                                                        <option value="<?= $time_range ?>" <?= (old("time_range", $_GET["time_range"] ?? \Http\Enums\ReservationTimeRange::RESERVE_8HRS)) == $time_range ? "selected" : "" ?>><?= ucfirst($time_range) ?></option>
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
                                            <label for="check_out">Check Out</label>
                                            <div class="form-clt">
                                                <input type="text" name="check_out" id="check_out" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="facility">Facility</label>
                                            <div class="form-clt">
                                                <select name="facility" id="facility" class="single-select w-100">
                                                    <?php foreach ($facilities as $facility): ?>
                                                        <option value="<?= $facility['id'] ?>" data-rate-8hrs="<?= $facility['rate_8hrs'] ?>" data-rate-12hrs="<?= $facility['rate_12hrs'] ?>" data-rate-1day="<?= $facility['rate_1day'] ?>" data-type="<?= $facility["type"] ?>" data-pax="<?= $facility["capacity"] ?>" <?= (old("facility", $_GET["facility_id"] ?? 0)) == $facility["id"] ? "selected" : "" ?>><?= $facility['name'] ?> (<?= ucfirst($facility['type']) ?>)</option>
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
                                                <div class="error-text" id="guest_count_msg"></div>
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


                                <!-- Additionals -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Additionals</h4>
                                    <div class="row g-4">
                                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="additional_bed_count">Additional Bed Count</label>
                                            <div class="form-clt">
                                                <input type="number" name="additional_bed_count" id="additional_bed_count" value="<?= old("additional_bed_count", 0) ?>">
                                                <?php if (isset($errors["additional_bed_count"])) : ?>
                                                    <div class="error-text">
                                                        <?= $errors["additional_bed_count"] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Information -->
                                <div class="form-block">
                                    <h4 class="fw-bold">Payment Information</h4>
                                    <div class="row g-4">
                                        <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="total_rate">Total Rate</label>
                                            <div class="form-clt">
                                                <input type="number" name="total_rate" id="total_rate" disabled>
                                            </div>
                                            <div class="discount-container"></div>
                                        </div>
                                        <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                            <label for="booking_deposit">Booking Deposit</label>
                                            <div class="form-clt">
                                                <input type="number" name="booking_deposit" id="booking_deposit" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-4 mt-2" id="card-fields"></div>
                                </div>

                                <div class="d-flex justify-content-between gap-2 mt-2">
                                    <button type="button" id="viewTermsBtn" class="btn gt-theme-btn">PROCEED</button>
                                    <button type="button" class="gt-theme-secondary-btn" id="showBreakdownBtn">
                                        Payment Breakdown
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PDF Modal -->
    <div class="modal fade h-100" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="termsModalLabel">Terms & Conditions</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- PDF Viewer -->
                <div class="modal-body p-0">
                    <iframe id="pdfViewer" src="" frameborder="0" width="100%" height="500px"></iframe>
                </div>

                <!-- Checkbox & Submit -->
                <div class="modal-footer d-flex flex-column align-items-start">
                    <div>
                        <label for="terms" class="checkbox-container"> I have read and agree to the Terms and Conditions
                            <input type="checkbox" id="terms">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <button type="button" id="submitBtn" class="gt-theme-btn mt-2">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Breakdown Modal -->
    <div class="modal fade" id="paymentBreakdownModal" tabindex="-1" aria-labelledby="paymentBreakdownLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Customer Info -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-secondary border-bottom pb-2">Reservation Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Name:</strong> <span id="breakdown-name">N/A</span></p>
                                <p class="mb-1"><strong>Contact Number:</strong> <span id="breakdown-contact-number">N/A</span></p>
                                <p class="mb-1"><strong>Contact Email:</strong> <span id="breakdown-contact-email">N/A</span></p>
                                <p class="mb-1"><strong>Contact Address:</strong> <span id="breakdown-contact-address">N/A</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Check-in:</strong> <span id="breakdown-checkin">N/A</span></p>
                                <p class="mb-1"><strong>Check-out:</strong> <span id="breakdown-checkout">N/A</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Breakdown Table -->
                    <h6 class="fw-bold text-secondary pb-2">Payment Breakdown</h6>
                    <div class="payment-breakdown-table-container">
                        <table class="table table-bordered table-striped mb-3 ">
                            <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th class="text-end">Amount (₱)</th>
                                </tr>
                            </thead>
                            <tbody id="breakdown-body"></tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td>Total</td>
                                    <td class="text-end" id="breakdown-total">0.00</td>
                                </tr>
                                <tr>
                                    <td>50% Deposit</td>
                                    <td class="text-end text-primary" id="breakdown-deposit">0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>

    <!-- Calendar -->
    <script>
        $(document).ready(function() {
            const bookingsData = <?= json_encode($bookings) ?>;

            const calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                weekends: true,
                businessHours: false,
                defaultView: 'agendaWeek',
                editable: false,
                selectable: false,
                allDaySlot: false,
                minTime: "00:00:00",
                maxTime: "24:00:00",
                events: [] // Start empty
            });

            function updateCalendarEvents(facilityId) {
                $('#calendar').fullCalendar('removeEvents');

                if (!facilityId) return;

                const facilityBookings = bookingsData.filter(b => String(b.facility_id) === String(facilityId));
                if (facilityBookings.length === 0) return;

                const availableUnits = facilityBookings[0].available_unit; // assume same for this facility
                const fullyBookedSlots = [];

                // Iterate through bookings to find overlapping fully booked ranges
                for (let i = 0; i < facilityBookings.length; i++) {
                    const current = facilityBookings[i];
                    const start = new Date(current.check_in_date);
                    const end = new Date(current.check_out_date);
                    const endWithBuffer = new Date(end.getTime() + 60 * 60 * 1000); // +1 hr cleaning

                    // Count overlapping bookings within this time range
                    let overlapCount = 0;
                    for (let j = 0; j < facilityBookings.length; j++) {
                        const other = facilityBookings[j];
                        const otherStart = new Date(other.check_in_date);
                        const otherEnd = new Date(other.check_out_date);

                        if (start < otherEnd && end > otherStart) {
                            overlapCount++;
                        }
                    }

                    // Only add to calendar if all units are booked at that time
                    if (overlapCount >= availableUnits) {
                        fullyBookedSlots.push({
                            title: 'Not Available',
                            start: start,
                            end: endWithBuffer,
                            allDay: false,
                            backgroundColor: '#ff4d4d',
                            textColor: '#ffffff'
                        });
                    }
                }

                $('#calendar').fullCalendar('addEventSource', fullyBookedSlots);
            }

            $('#facility').on('change', function() {
                const facilityId = $(this).val();
                updateCalendarEvents(facilityId);
            });

            const facId = $("#facility").val();
            updateCalendarEvents(facId);
        });
    </script>

    <!-- Date picker -->
    <script>
        $(function() {
            const bookings = <?= json_encode($bookings) ?> || [];

            function parseDateTime(str) {
                if (!str) return null;
                str = str.trim().replace(' ', 'T');
                if (str.length === 16) str += ':00';
                const d = new Date(str);
                return isNaN(d.getTime()) ? null : d;
            }

            function formatDateTime(d) {
                if (!d) return '';
                const pad = n => (n < 10 ? '0' + n : n);
                return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
            }

            function formatReadableDateTime(d) {
                if (!d) return '';
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true,
                };
                return d.toLocaleString('en-US', options);
            }

            function parseDurationEnum(val) {
                switch (val) {
                    case '8-Hours':
                        return 8;
                    case '12-Hours':
                        return 12;
                    case '1-Day':
                        return 24;
                    default:
                        return 0;
                }
            }

            function overlaps(aStart, aEnd, bStart, bEnd) {
                return aStart < bEnd && aEnd > bStart;
            }

            const isExclusive = () => {
                const facilityTypes = <?= json_encode(\Http\Enums\FacilityType::toArray()) ?> || [];
                const facilityType = $("#facility option:selected").data("type");
                return facilityType == facilityTypes.EXCLUSIVE;
            }

            $('#check_in').flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minDate: "today",
                onChange: function() {
                    checkAvailability();
                }
            });

            $('#check_in, #time_range, #facility').on('change blur', checkAvailability);

            function checkAvailability() {
                $('#check_in_msg').text('');
                $('#viewTermsBtn').prop('disabled', false);

                const facilityId = $('#facility').val();
                const checkInRaw = $('#check_in').val();
                const durationVal = $('#time_range').val();

                if (!checkInRaw) {
                    $('#check_out').val('');
                    return;
                }

                const selStart = parseDateTime(checkInRaw);
                if (!selStart) {
                    $('#viewTermsBtn').prop('disabled', true);
                    return;
                }

                const hours = parseDurationEnum(durationVal);
                const selEnd = new Date(selStart.getTime() + hours * 60 * 60 * 1000);
                $('#check_out').val(formatDateTime(selEnd));

                if (!facilityId) return;

                // Count overlapping bookings
                let overlapCount = 0;
                let conflictDetails = [];

                // Check overlaps on exclusive
                if (isExclusive()) {
                    for (let i = 0; i < bookings.length; i++) {
                        const b = bookings[i];
                        const bStart = parseDateTime(b.check_in_date);
                        const bEnd = parseDateTime(b.check_out_date);
                        if (!bStart || !bEnd) continue;

                        // Add 1-hour cleaning buffer
                        const bEndWithCleaning = new Date(bEnd.getTime() + 60 * 60 * 1000);

                        if (overlaps(selStart, selEnd, bStart, bEndWithCleaning)) {
                            overlapCount++;
                            conflictDetails.push({
                                start: bStart,
                                end: bEndWithCleaning
                            });
                        }
                    }

                    if (overlapCount > 0) {
                        let conflictText = conflictDetails
                            .map(c => `<strong>${formatReadableDateTime(c.start)}</strong> → <strong>${formatReadableDateTime(c.end)}</strong>`)
                            .join('<br>');

                        $('#check_in_msg').html(
                            `<strong>Selected check-in time is unavailable.</strong><br>
                        Unit(s) are booked during:<br>${conflictText}`
                        );
                        $('#viewTermsBtn').prop('disabled', true);
                        return;
                    }
                }

                // Filter bookings by facility
                const facilityBookings = bookings.filter(b => String(b.facility_id) === String(facilityId));
                if (facilityBookings.length === 0) return;

                const availableUnits = facilityBookings[0].available_unit || 1;

                // Check overlaps on same facility
                for (let i = 0; i < facilityBookings.length; i++) {
                    const b = facilityBookings[i];
                    const bStart = parseDateTime(b.check_in_date);
                    const bEnd = parseDateTime(b.check_out_date);
                    if (!bStart || !bEnd) continue;

                    // Add 1-hour cleaning buffer
                    const bEndWithCleaning = new Date(bEnd.getTime() + 60 * 60 * 1000);

                    if (overlaps(selStart, selEnd, bStart, bEndWithCleaning)) {
                        overlapCount++;
                        conflictDetails.push({
                            start: bStart,
                            end: bEndWithCleaning
                        });
                    }
                }

                // Disable only if all units are occupied
                if (overlapCount >= availableUnits) {
                    let conflictText = conflictDetails
                        .map(c => `<strong>${formatReadableDateTime(c.start)}</strong> → <strong>${formatReadableDateTime(c.end)}</strong>`)
                        .join('<br>');

                    $('#check_in_msg').html(
                        `<strong>Selected check-in time is unavailable.</strong><br>
                 All ${availableUnits} unit(s) are booked during:<br>${conflictText}`
                    );
                    $('#viewTermsBtn').prop('disabled', true);
                    return;
                }

                $('#check_in_msg').text('');
                $('#viewTermsBtn').prop('disabled', false);
            }
        });
    </script>

    <!-- Generate Guest Fields -->
    <script>
        $(document).ready(function() {
            const capacity = () => parseInt($("#facility option:selected").data("pax"));
            const changeMax = (cap) => $('#guest_count').attr('max', cap);
            const changeFacPax = () => {
                const currentCap = <?= $_GET["guest_count"] ?? 0 ?>;
                let count = currentCap > 0 ? currentCap : capacity();
                changeMax(count);
                $("#guest_count").val(count);
                generateGuestFields(count);
            };
            const generateGuestFields = (count) => {
                let $container = $("#guest-list");
                $container.empty(); // clear old fields

                let oldValues = <?= json_encode(old('guests', [])) ?>;

                if (count > 0) {
                    for (let i = 0; i < count; i++) {
                        let fieldGroup = `
                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s"> 
                            <label for"guests[${i}][guest_name]">Guest ${i + 1} Name</label>
                            <div class="form-clt">
                                <input type="text" name="guests[${i}][guest_name]" id="guests[${i}][guest_name]" placeholder="Guest Name" value="${oldValues[i]?.guest_name ?? ''}" required>
                            </div>
                        </div> 
                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s"> 
                            <label for"guests[${i}][guest_age]">Age</label>
                            <div class="form-clt">
                                <input type="number" name="guests[${i}][guest_age]" id="guests[${i}][guest_age]" placeholder="Guest Age" value="${oldValues[i]?.guest_age ?? ''}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 wow fadeInUp" data-wow-delay=".3s"> 
                            <label for="guests[${i}][senior_pwd]">Senior/PWD</label> 
                            <div class="form-clt">
                                <select name="guests[${i}][senior_pwd]" id="guests[${i}][senior_pwd]" class="single-select w-100"> 
                                    <?php foreach (\Http\Enums\YesNo::toArray() as $yesNo): ?>
                                        <option value="<?= $yesNo ?>" ${(oldValues[i]?.senior_pwd ?? "") == "<?= $yesNo ?>" ? "selected" : ""}><?= ucfirst($yesNo) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> 
                        </div>
                        `;
                        $container.append(fieldGroup);
                    }
                }
            }

            $("#facility").on('change', changeFacPax);
            $("#guest_count, #facility").on('change blur', () => {
                $('#guest_count_msg').text('');
                $('#viewTermsBtn').prop('disabled', false);

                const count = $('#guest_count').val();

                if (count > capacity()) {
                    $('#guest_count_msg').text(`Guest count exceeds facility capacity: ${capacity()}`);
                    $('#viewTermsBtn').prop('disabled', true);
                    return;
                }

                generateGuestFields(count);
            });

            changeFacPax();
        });
    </script>

    <!-- Generate Total Rate -->
    <script>
        $(function() {
            // --- Injected from PHP ---
            const rates = <?= json_encode($rates) ?>;
            const promos = <?= json_encode($promos) ?>;
            const discountTypes = <?= json_encode(\Http\Enums\DiscountType::toArray()) ?>;
            const reservationTimeRanges = <?= json_encode(\Http\Enums\ReservationTimeRange::toArray()) ?>;
            const yesNo = <?= json_encode(\Http\Enums\YesNo::toArray()) ?>;
            const guestType = <?= json_encode(\Http\Enums\GuestType::toArray()) ?>;
            const timeSlots = <?= json_encode(\Http\Enums\TimeSlot::toArray()) ?>;

            // ---------------------------------------------------------
            // Helpers
            // ---------------------------------------------------------

            const isDaySlot = (checkIn) => {
                const d = new Date(checkIn);
                if (isNaN(d)) return null;
                const hour = d.getHours();
                return hour >= 6 && hour < 18;
            };

            const getFacilityRateByTimeRange = () => {
                const facilityEl = $("#facility option:selected");
                const timeRange = $("#time_range").val() || reservationTimeRanges.RESERVE_8HRS;

                const rateMap = {
                    [reservationTimeRanges.RESERVE_8HRS]: "rate-8hrs",
                    [reservationTimeRanges.RESERVE_12HRS]: "rate-12hrs",
                    [reservationTimeRanges.RESERVE_1DAY]: "rate-1day",
                };

                const rateKey = rateMap[timeRange];
                return parseFloat(facilityEl.data(rateKey)) || 0;
            };

            const applyPromo = (facilityRate) => {
                $(".discount-container").empty();

                const facilityId = Number($("#facility").val());

                for (const promo of promos) {
                    const promoFacilities = promo.facilities.split(",").map(Number);
                    if (!promoFacilities.includes(facilityId)) continue;

                    const discountValue = parseFloat(promo.discount_value);
                    const isPercent = promo.discount_type == discountTypes.PERCENTAGE_OFF;

                    const discountedValue = isPercent ?
                        facilityRate * (discountValue / 100) :
                        discountValue;

                    const discountedRate = Math.max(0, facilityRate - discountedValue);

                    $(".discount-container").html(`
                        <span class="badge bg-primary">${promo.title}</span>
                    `);

                    return discountedRate;
                }

                return facilityRate;
            };

            const computeGuestRate = (guestIndex, timeSlot) => {
                const name = $(`[name='guests[${guestIndex}][guest_name]']`).val();
                const age = Number($(`[name='guests[${guestIndex}][guest_age]']`).val());
                if (name && age) {
                    const isAdult = age >= 10;
                    const isSenior = $(`[name='guests[${guestIndex}][senior_pwd]']`).val() === yesNo.YES;

                    const rateKey = isAdult ? `adult_rate_${timeSlot}` : `kid_rate_${timeSlot}`;
                    let rate = parseFloat(rates[rateKey]) || 0;

                    if (isSenior) {
                        const discountPercent = parseFloat(rates.senior_pwd_discount) || 0;
                        rate -= rate * (discountPercent / 100);
                        rate = Math.max(0, rate);
                    }

                    return rate;
                }
                return 0;
            };

            const computeAdditionals = () => {
                let additionalTotal = 0;
                const additionalBedCount = $("#additional_bed_count").val();
                if (additionalBedCount > 0)
                    additionalTotal += additionalBedCount * rates.additional_bed_rate;
                return additionalTotal;
            }

            const formatDateTime = (value) => {
                if (!value) return "N/A";
                const date = new Date(value);
                if (isNaN(date)) return "N/A";
                return date.toLocaleString("en-US", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true,
                });
            };

            // ---------------------------------------------------------
            // Main calculator
            // ---------------------------------------------------------

            const computeTotal = () => {
                let total = 0;

                // Facility Rate
                const rawFacilityRate = getFacilityRateByTimeRange();
                const facilityRate = applyPromo(rawFacilityRate);
                total += facilityRate;

                // Time slot (day/night)
                const checkIn = $("#check_in").val();
                const timeSlot = isDaySlot(checkIn) ? timeSlots.DAY : timeSlots.NIGHT;
                $("#time_slot").val(timeSlot);

                // Guests
                $("#guest-list [name*='[guest_age]']").each(function() {
                    const guestIndex = this.name.match(/\d+/)[0];
                    total += computeGuestRate(guestIndex, timeSlot);
                });

                // Videoke
                if ($("#rent_videoke").val() === yesNo.YES) {
                    total += parseFloat(rates.videoke_rent) || 0;
                }

                // Additionals
                total += computeAdditionals();

                // Output
                $("#total_rate").val(total.toFixed(2));
                $("#booking_deposit").val((total / 2).toFixed(2));
            };


            // ---------------------------------------------------------
            // Payment Breakdown
            // ---------------------------------------------------------
            const showPaymentBreakdown = () => {
                const breakdownBody = $("#breakdown-body");
                breakdownBody.empty();

                // Collect User Info
                const name = $("#contact_person").val() || "N/A";
                const contactNum = $("#contact_no").val() || "N/A";
                const contactEmail = $("#contact_email").val() || "N/A";
                const contactAdd = $("#contact_address").val() || "N/A";
                const checkInRaw = $("#check_in").val();
                const checkOutRaw = $("#check_out").val();

                // Update top info in modal
                $("#breakdown-name").text(name);
                $("#breakdown-contact-number").text(contactNum);
                $("#breakdown-contact-email").text(contactEmail);
                $("#breakdown-contact-address").text(contactAdd);
                $("#breakdown-checkin").text(formatDateTime(checkInRaw));
                $("#breakdown-checkout").text(formatDateTime(checkOutRaw));

                // Facility Rate
                const rawFacilityRate = getFacilityRateByTimeRange();
                const facilityRate = applyPromo(rawFacilityRate);
                const timeRange = $("#time_range").val();
                const hasPromo = rawFacilityRate !== facilityRate;
                breakdownBody.append(`
                    <tr>
                        <td>Facility Rate (${timeRange}) ${hasPromo ? '<small class="text-success">(Promo Applied)</small>' : ''}</td>
                        <td class="text-end">${facilityRate.toFixed(2)}</td>
                    </tr>
                `);

                // Guests 
                const timeSlot = isDaySlot(checkInRaw) ? timeSlots.DAY : timeSlots.NIGHT;
                let guestTotal = 0;
                $("#guest-list [name*='[guest_age]']").each(function() {
                    const guestIndex = this.name.match(/\d+/)[0];
                    const name = $(`[name='guests[${guestIndex}][guest_name]']`).val();
                    const age = $(`[name='guests[${guestIndex}][guest_age]']`).val();
                    const isSenior = $(`[name='guests[${guestIndex}][senior_pwd]']`).val() === yesNo.YES;
                    if (name && age) {
                        const rate = computeGuestRate(guestIndex, timeSlot);
                        guestTotal += rate;

                        breakdownBody.append(`
                        <tr>
                            <td>Guest #${Number(guestIndex) + 1} (Name: ${name}, Age: ${age} ${isSenior ? ', Senior/PWD' : ''})</td>
                            <td class="text-end">${rate.toFixed(2)}</td>
                        </tr>
                    `);
                    }
                });

                // Videoke
                let videokeTotal = 0;
                if ($("#rent_videoke").val() === yesNo.YES) {
                    videokeTotal = parseFloat(rates.videoke_rent) || 0;
                    breakdownBody.append(`
                        <tr>
                            <td>Videoke Rental</td>
                            <td class="text-end">${videokeTotal.toFixed(2)}</td>
                        </tr>
                    `);
                }

                // Additionals
                let addTotal = computeAdditionals();
                if (addTotal > 0) {
                    const bedCount = $("#additional_bed_count").val();
                    breakdownBody.append(`
                        <tr>
                            <td>Additional Bed x${bedCount}</td>
                            <td class="text-end">${addTotal.toFixed(2)}</td>
                        </tr>
                    `);
                }

                // Total & Deposit
                const total = facilityRate + guestTotal + videokeTotal + addTotal;
                const deposit = total / 2;

                $("#breakdown-total").text(total.toFixed(2));
                $("#breakdown-deposit").text(deposit.toFixed(2));

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById("paymentBreakdownModal"));
                modal.show();
            };

            // ---------------------------------------------------------
            // Events
            // ---------------------------------------------------------

            $(document).on(
                "change input",
                "#time_range, #check_in, #rent_videoke, #facility, #guest-list input, #guest-list select, #additional_bed_count",
                computeTotal
            );


            $("#showBreakdownBtn").on("click", showPaymentBreakdown);
        });
    </script>

    <!-- PDF Modal -->
    <script>
        $(document).ready(function() {
            $('#submitBtn').prop('disabled', true);

            $('#viewTermsBtn').on('click', function() {
                const pdfUrl = "<?= $terms['filepath'] ?>";
                $('#pdfViewer').attr('src', pdfUrl);
                $('#termsModal').modal('show');
            });

            $('#termsModal').on('hidden.bs.modal', function() {
                $('#pdfViewer').attr('src', '');
                $('#terms').prop('checked', false);
                $('#submitBtn').prop('disabled', true);
            });

            $('#terms').on('change', function() {
                $('#submitBtn').prop('disabled', !this.checked);
            });

            $('#submitBtn').on('click', function() {
                $("#bookingForm").submit();
                $('#termsModal').modal('hide');
            });
        });
    </script>
</body>

</html>