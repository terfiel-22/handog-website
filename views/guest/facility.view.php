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
                                    <form action="/booking" method="GET">
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <div class="error-text" id="error_message"></div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <div class="form">
                                                        <select name="facility_id" id="facility_id" class="single-select w-100" required>
                                                            <?php foreach ($facilities as $facility): ?>
                                                                <option value="<?= $facility['id'] ?>" data-rate-8hrs="<?= $facility['rate_8hrs'] ?>" data-rate-12hrs="<?= $facility['rate_12hrs'] ?>" data-rate-1day="<?= $facility['rate_1day'] ?>" <?= $_GET["id"] == $facility["id"] ? "selected" : "" ?>><?= $facility['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <input type="text" id="check_in" name="check_in" placeholder="Check In" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <select name="time_range" id="time_range" class="single-select w-100" required>
                                                        <?php foreach (\Http\Enums\ReservationTimeRange::toArray() as $time_range): ?>
                                                            <option value="<?= $time_range ?>"><?= ucfirst($time_range) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <input type="text" id="check_out" name="check_out" placeholder="Check Out" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-clt">
                                                    <div class="form">
                                                        <input type="number" id="guest_count" name="guest_count" placeholder="Guest Count" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="gt-theme-btn w-100" type="submit" id="submitBtn">
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

    <!-- Date Picker -->
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
                const facilityType = $("#facility_id option:selected").data("type");
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

            $('#check_in, #time_range, #facility_id').on('change blur', checkAvailability);

            function checkAvailability() {
                $('#error_message').text('');
                $('#submitBtn').prop('disabled', false);

                const facilityId = $('#facility_id').val();
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

                        $('#error_message').html(
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

                    $('#error_message').html(
                        `<strong>Selected check-in time is unavailable.</strong><br>
                 All ${availableUnits} unit(s) are booked during:<br>${conflictText}`
                    );
                    $('#submitBtn').prop('disabled', true);
                    return;
                }

                $('#error_message').text('');
                $('#submitBtn').prop('disabled', false);
            }
        });
    </script>

    <!-- Guest Count -->
    <script>
        $(function() {

        });
    </script>
</body>

</html>