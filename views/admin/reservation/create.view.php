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
                        <div class="card-body">
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
                                                    <option value="<?= $facility['id'] ?>" data-rate-8hrs="<?= $facility['rate_8hrs'] ?>" data-rate-12hrs="<?= $facility['rate_12hrs'] ?>" data-rate-1day="<?= $facility['rate_1day'] ?>"><?= $facility['name'] ?> (<?= ucfirst($facility['type']) ?>)</option>
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
                                                    <option value="<?= $time_range ?>"><?= $time_range ?></option>
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
                                            <input type="text" name="check_in" id="check_in" class="form-control" value="<?= old("check_in", ($_GET["check_in"] ?? date("d/m/Y H:i"))) ?>">
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
                                            <input type="text" name="contact_address" id="contact_address" class="form-control" placeholder="Enter Email" value="<?= old("contact_address") ?>">
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
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="payment_status">Payment Status</label>
                                            <select name="payment_status" id="payment_status" class="form-control">
                                                <?php foreach (\Http\Enums\PaymentStatus::toArray() as $payment_status): ?>
                                                    <option value="<?= $payment_status ?>"><?= $payment_status ?></option>
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
                                            <button type="submit" class="btn btn-primary">Submit</button>
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

                // Filter bookings by facility
                const facilityBookings = bookings.filter(b => String(b.facility_id) === String(facilityId));
                if (facilityBookings.length === 0) return;

                const availableUnits = facilityBookings[0].available_unit || 1;

                // Count overlapping bookings
                let overlapCount = 0;
                let conflictDetails = [];

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
            const generateGuestFields = (count) => {
                let $container = $("#guest-list");
                $container.empty(); // clear old fields

                if (count > 0) {
                    for (let i = 1; i <= count; i++) {
                        let fieldGroup = `
                        <div class="col-12"> 
                            <label>Guest ${i}</label>
                            <input type="text" name="guests[${i}][guest_name]" class="form-control" placeholder="Enter name">
                        </div> 
                        <div class="col-12">
                            <label>Age</label>
                            <input type="number" name="guests[${i}][guest_age]" class="form-control" placeholder="Enter age" min="0">
                        </div> 
                        <div class="col-12">
                            <label>Senior/PWD</label>
                            <select name="guests[${i}][senior_pwd]" class="form-control"> 
                                <?php foreach (\Http\Enums\YesNo::toArray() as $yesNo): ?>
                                    <option value="<?= $yesNo ?>"><?= ucfirst($yesNo) ?></option>
                                <?php endforeach; ?>
                            </select>
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
            generateGuestFields(1);
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
                $("#guest-list").find("[name*='[guest_age]']").each(function() {
                    const guestIndex = $(this).attr("name").match(/\d+/)[0]; // extract index
                    const age = $(`[name='guests[${guestIndex}][guest_age]']`).val();
                    const type = age >= 10 ? guestType.ADULT : guestType.KID;
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
                $("#booking_deposit").val((total / 2).toFixed(2));
            }

            // Recompute whenever form values change
            $(document).on("change input", "#time_range, #check_in, #rent_videoke, #facility, #guest-list input", computeTotal);

            // Initial compute
            computeTotal();
        });
    </script>

</body>

</html>