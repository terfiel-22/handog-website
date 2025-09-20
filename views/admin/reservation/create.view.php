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
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="guest_count">Guest Count</label>
                                    <input type="number" id="guest_count" name="guest_count" class="form-control" min="0" max="99" value="1">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="facility">Facility</label>
                                    <select name="facility" id="facility" class="form-control">
                                        <?php foreach ($facilities as $facility): ?>
                                            <option value="<?= $facility['id'] ?>"><?= $facility['name'] ?> (<?= ucfirst($facility['type']) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
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
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="contact_no">Contact Number</label>
                                    <input type="tel" name="contact_no" id="contact_no" class="form-control" placeholder="Enter Phone No.">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="contact_email">Contact Email</label>
                                    <input type="text" name="contact_email" id="contact_email" class="form-control" placeholder="Enter Email">
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
                            <input type="text" name="persons[${i}][guest_name]" class="form-control" placeholder="Enter name">
                        </div> 
                        <div class="col-12 col-md-2">
                            <label>Age</label>
                            <input type="number" name="persons[${i}][guest_age]" class="form-control" placeholder="Enter age">
                        </div>
                        <div class="col-12 col-md-2">
                            <label>Type</label>
                            <select name="persons[${i}][guest_type]" class="form-control">
                                <?php foreach (\Http\Enums\GuestType::toArray() as $type): ?>
                                    <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <label>Senior/PWD</label>
                            <select name="persons[${i}][senior_pwd]" class="form-control"> 
                                <option value="0">No</option>
                                <option value="1">Yes</option>
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