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

            <!-- Form -->
            <div class="card basic-data-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Add Reservation</h6>
                </div>
                <div class="card-body">
                    <form action="/admin/reservations/store" method="POST">
                        <!-- Step 1 -->
                        <div class="step active">
                            <h6>Step 1: Reservation</h6>
                            <div class="row gy-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="time_slot">Time Slot</label>
                                    <select name="time_slot" id="time_slot" class="form-control">
                                        <?php foreach (\Http\Enums\TimeSlot::toArray() as $timeSlot): ?>
                                            <option value="<?= $timeSlot ?>"><?= ucfirst($timeSlot) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($errors["time_slot"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["time_slot"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="guest_count">Guest Count</label>
                                    <input type="number" id="guest_count" name="guest_count" class="form-control" min="0" max="99" value="<?= old("guest_count") || 1 ?>">
                                    <?php if (isset($errors["guest_count"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["guest_count"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-4">
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
                                <div class="col-12 col-md-6">
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
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="time_range">Time Range</label>
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
                                    <a href="/admin/reservations" class="btn btn-danger-600">Cancel</a>
                                    <button type="button" class="btn btn-primary next">Next</button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step">
                            <h6>Step 2: Contact Info</h6>
                            <div class="row gy-3">
                                <div class="col-12 col-md-12">
                                    <label class="form-label" for="contact_person">Contact Person</label>
                                    <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Enter Name" value="<?= old("contact_person") ?>">
                                    <?php if (isset($errors["contact_person"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["contact_person"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="contact_no">Phone Number</label>
                                    <input type="tel" name="contact_no" id="contact_no" class="form-control" placeholder="Enter Phone No." value="<?= old("contact_no") ?>">
                                    <?php if (isset($errors["contact_no"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["contact_no"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-6">
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
                                <div id="facility-fields" class="col-12 row gy-3"></div>
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
                                <div class="col-12 col-md-6">
                                    <label for="total_rate" class="form-label">Total Rate</label>
                                    <input type="number" id="total_rate" class="form-control" disabled>
                                </div>
                                <div class="col-12 col-md-6">
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
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <!-- Generate Guest Fields -->
    <script>
        $(document).ready(function() {
            const generateGuestFields = (count) => {
                let $container = $("#facility-fields");
                $container.empty(); // clear old fields

                if (count > 0) {
                    for (let i = 1; i <= count; i++) {
                        let fieldGroup = `
                        <div class="col-12 col-md-6"> 
                            <label>Guest ${i}</label>
                            <input type="text" name="guests[${i}][guest_name]" class="form-control" placeholder="Enter name">
                        </div> 
                        <div class="col-12 col-md-2">
                            <label>Age</label>
                            <input type="number" name="guests[${i}][guest_age]" class="form-control" placeholder="Enter age" min="0">
                        </div>
                        <div class="col-12 col-md-2">
                            <label>Type</label>
                            <select name="guests[${i}][guest_type]" class="form-control">
                                <?php foreach (\Http\Enums\GuestType::toArray() as $type): ?>
                                    <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
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
                const timeSlot = $("#time_slot").val() || timeSlots.DAY;
                // --- Guest rates (adult/kid per day/night) ---
                $("#facility-fields").find("[name*='[guest_type]']").each(function() {
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
            $(document).on("change input", "#time_range, #time_slot, #rent_videoke, #facility, #facility-fields select", computeTotal);

            // Initial compute
            computeTotal();
        });
    </script>

</body>

</html>