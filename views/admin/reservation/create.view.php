<?php
$pageName = "Reservations"
?>

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<!-- Head Tag -->
<?php view("admin/partials/head.partial.php", [
    'title' => "Handog Admin | " . $pageName
]) ?>

<body>

    <!-- Sidebar -->
    <?php view("admin/partials/sidebar.partial.php") ?>

    <!-- Main Section -->
    <main class="dashboard-main">

        <!-- Sidebar -->
        <?php view("admin/partials/navbar.partial.php") ?>


        <div class="dashboard-main-body">

            <!-- Breadcrumbs -->
            <?php view("admin/partials/breadcrumb.partial.php", compact('pageName')) ?>

            <div class="row g-4 justify-content-center">
                <!-- Calendar -->
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
                <!-- Form -->
                <div class="col-12 col-md-4">
                    <div class="card basic-data-table">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0">Add Reservation</h6>
                        </div>
                        <div class="card-body step-container">
                            <form action="/admin/reservations/store" method="POST">
                                <input type="hidden" name="time_slot" id="time_slot">
                                <!-- Step 1 -->
                                <div class="step active">
                                    <h6>Step 1: Reservation</h6>
                                    <div class="error-text" role="alert" id="check_in_msg"></div>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label" for="facility">Facility</label>
                                            <select name="facility" id="facility" class="form-control">
                                                <?php foreach ($facilities as $facility): ?>
                                                    <option value="<?= $facility['id'] ?>" data-rate-8hrs="<?= $facility['rate_8hrs'] ?>" data-rate-12hrs="<?= $facility['rate_12hrs'] ?>" data-rate-1day="<?= $facility['rate_1day'] ?>" data-type="<?= $facility["type"] ?>" data-pax="<?= $facility["capacity"] ?>" <?= old("facility") == $facility["id"] ? "selected" : "" ?>><?= $facility['name'] ?> (<?= ucfirst($facility['type']) ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($errors["facility"])) : ?>
                                                <div class=" error-text">
                                                    <?= $errors["facility"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="time_range">Hours Stay</label>
                                            <select name="time_range" id="time_range" class="form-control">
                                                <?php foreach (\Http\Enums\ReservationTimeRange::toArray() as $time_range): ?>
                                                    <option value="<?= $time_range ?>" <?= old('time_range') == $time_range ? "selected" : "" ?>><?= $time_range ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($errors["time_range"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["time_range"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="check_in">Check In</label>
                                            <input type="text" name="check_in" id="check_in" class="form-control" value="<?= old("check_in",  date("d/m/Y H:i")) ?>">
                                            <?php if (isset($errors["check_in"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["check_in"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="check_out">Check Out</label>
                                            <input type="text" name="check_out" id="check_out" class="form-control" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="guest_count">Guest Count</label>
                                            <input type="number" id="guest_count" name="guest_count" class="form-control" min="0" max="99" value="<?= old("guest_count") || 1 ?>">
                                            <?php if (isset($errors["guest_count"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["guest_count"] ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="error-text" id="guest_count_msg"></div>
                                        </div>
                                        <div class="col-12">
                                            <label for="rent_videoke">Rent Videoke?</label>
                                            <select name="rent_videoke" id="rent_videoke" class="form-control">
                                                <?php foreach (\Http\Enums\YesNo::toArray() as $yesNo): ?>
                                                    <option value="<?= $yesNo ?>"><?= ucfirst($yesNo) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($errors["rent_videoke"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["rent_videoke"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <a href="/admin/reservations" class="btn btn-danger-600">Cancel</a>
                                            <button type="button" id="nextBtn" class="btn btn-primary next">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="step">
                                    <h6>Step 2: Contact Info</h6>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label" for="contact_person">Contact Person</label>
                                            <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Enter Name" value="<?= old("contact_person") ?>">
                                            <?php if (isset($errors["contact_person"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["contact_person"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="contact_no">Phone Number</label>
                                            <input type="tel" name="contact_no" id="contact_no" class="form-control" placeholder="Enter Phone No." value="<?= old("contact_no") ?>">
                                            <?php if (isset($errors["contact_no"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["contact_no"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="contact_email">Email</label>
                                            <input type="text" name="contact_email" id="contact_email" class="form-control" placeholder="Enter Email" value="<?= old("contact_email") ?>">
                                            <?php if (isset($errors["contact_email"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["contact_email"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="contact_address">Address</label>
                                            <input type="text" name="contact_address" id="contact_address" class="form-control" placeholder="Enter Address" value="<?= old("contact_address") ?>">
                                            <?php if (isset($errors["contact_address"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["contact_address"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-secondary prev">Previous</button>
                                            <button type="button" class="btn btn-primary next">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="step">
                                    <h6>Step 3: Guest Info</h6>
                                    <div class="row gy-3">
                                        <div id="guest-list" class="col-12 row gy-3"></div>
                                        <?php if (isset($errors["guests"])) : ?>
                                            <div class="error-text">
                                                <?= $errors["guests"] ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-secondary prev">Previous</button>
                                            <button type="button" class="btn btn-primary next">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="step">
                                    <h6>Step 4: Completion</h6>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label for="total_rate" class="form-label">Total Rate</label>
                                            <input type="number" id="total_rate" class="form-control" disabled>
                                            <div class="discount-container"></div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="payment_status">Payment Status</label>
                                            <select name="payment_status" id="payment_status" class="form-control">
                                                <?php foreach (\Http\Enums\PaymentStatus::toArray() as $payment_status): ?>
                                                    <option value="<?= $payment_status ?>" <?= old('payment_status') == $payment_status ? "selected" : "" ?>><?= $payment_status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($errors["payment_status"])) : ?>
                                                <div class="error-text">
                                                    <?= $errors["payment_status"] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-secondary prev">Previous</button>
                                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

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
                $('#submitBtn').prop('disabled', false);

                const facilityId = $('#facility').val();
                const checkInRaw = $('#check_in').val();
                const durationVal = $('#time_range').val();

                if (!checkInRaw) {
                    $('#check_out').val('');
                    return;
                }

                const selStart = parseDateTime(checkInRaw);
                if (!selStart) {
                    $('#submitBtn').prop('disabled', true);
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
                        $('#submitBtn').prop('disabled', true);
                        return;
                    }
                }

                // Filter bookings by facility
                const facilityBookings = bookings.filter(b => String(b.facility_id) === String(facilityId));
                if (facilityBookings.length === 0) return;

                const availableUnits = facilityBookings[0].available_unit || 1;

                // Count overlapping bookings
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
                    $('#nextBtn').prop('disabled', true);
                    return;
                }

                $('#check_in_msg').text('');
                $('#nextBtn').prop('disabled', false);
            }
        });
    </script>

    <!-- Generate Guest Fields -->
    <script>
        $(document).ready(function() {
            const capacity = () => parseInt($("#facility option:selected").data("pax"));
            const changeMax = (cap) => $('#guest_count').attr('max', cap);
            const changeFacPax = () => {
                changeMax(capacity());
                $("#guest_count").val(capacity());
                generateGuestFields(capacity());
            };
            const generateGuestFields = (count) => {
                let $container = $("#guest-list");
                $container.empty(); // clear old fields

                // Inject PHP
                let oldValues = <?= json_encode(old('guests', [])) ?>;

                if (count > 0) {
                    for (let i = 0; i < count; i++) {
                        let fieldGroup = `
                        <p class="lead">Guest ${i + 1}</p>
                        <div class="col-12 row py-2 gap-1"> 
                            <div class="col-12 wow fadeInUp" data-wow-delay=".3s"> 
                                <label for"guests[${i}][guest_name]">Name</label>
                                <div class="form-clt">
                                    <input type="text" name="guests[${i}][guest_name]" id="guests[${i}][guest_name]" placeholder="Name" value="${oldValues[i]?.guest_name ?? ''}" class="form-control" required>
                                </div>
                            </div> 
                            <div class="col-12 wow fadeInUp" data-wow-delay=".3s"> 
                                <label for"guests[${i}][guest_age]">Age</label>
                                <div class="form-clt">
                                    <input type="number" name="guests[${i}][guest_age]" id="guests[${i}][guest_age]" placeholder="Age" value="${oldValues[i]?.guest_age ?? ''}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 wow fadeInUp" data-wow-delay=".3s"> 
                                <label for="guests[${i}][senior_pwd]">Senior/PWD</label> 
                                <div class="form-clt">
                                    <select name="guests[${i}][senior_pwd]" id="guests[${i}][senior_pwd]" class="single-select form-select w-100"> 
                                        <?php foreach (\Http\Enums\YesNo::toArray() as $yesNo): ?>
                                            <option value="<?= $yesNo ?>" ${(oldValues[i]?.senior_pwd ?? "") == "<?= $yesNo ?>" ? "selected" : ""}><?= ucfirst($yesNo) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 
                            </div>
                        </div>
                        <hr/>
                        `;
                        $container.append(fieldGroup);
                    }
                }
            }

            $("#facility").on('change', changeFacPax);
            $("#guest_count, #facility").on('change blur', () => {
                $('#guest_count_msg').text('');
                $('#submitBtn').prop('disabled', false);

                const count = $('#guest_count').val();

                if (count > capacity()) {
                    $('#guest_count_msg').text(`Guest count exceeds facility capacity: ${capacity()}`);
                    $('#submitBtn').prop('disabled', true);
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
                const age = Number($(`[name='guests[${guestIndex}][guest_age]']`).val());
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

                // Output
                $("#total_rate").val(total.toFixed(2));
            };

            // ---------------------------------------------------------
            // Events
            // ---------------------------------------------------------

            $(document).on(
                "change input",
                "#time_range, #check_in, #rent_videoke, #facility, #guest-list input",
                computeTotal
            );
        });
    </script>

</body>

</html>