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

            <!-- Table -->
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
                                <div class="col-12 col-md-6">
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
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="guest_count">Guest Count</label>
                                    <input type="number" id="guest_count" name="guest_count" class="form-control" min="0" max="99" value="1">
                                    <?php if (isset($errors["guest_count"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["guest_count"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="facility">Facility</label>
                                    <select name="facility" id="facility" class="form-control">
                                        <?php foreach ($facilities as $facility): ?>
                                            <option value="<?= $facility['id'] ?>"><?= $facility['name'] ?> (<?= ucfirst($facility['type']) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($errors["facility"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["facility"] ?>
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
                                    <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Enter Name">
                                    <?php if (isset($errors["contact_person"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["contact_person"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="contact_no">Phone Number</label>
                                    <input type="tel" name="contact_no" id="contact_no" class="form-control" placeholder="Enter Phone No.">
                                    <?php if (isset($errors["contact_no"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["contact_no"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="contact_email">Email</label>
                                    <input type="text" name="contact_email" id="contact_email" class="form-control" placeholder="Enter Email">
                                    <?php if (isset($errors["contact_email"])) : ?>
                                        <div class="error-text">
                                            <?= $errors["contact_email"] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="contact_address">Address</label>
                                    <input type="text" name="contact_address" id="contact_address" class="form-control" placeholder="Enter Email">
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

</body>

</html>