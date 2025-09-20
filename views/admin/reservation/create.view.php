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
                                    <label class="form-label" for="check_in">Check In</label>
                                    <input type="time" name="check_in" id="check_in" class="form-control" placeholder="Enter Check In">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="facility">Facility</label>
                                    <select name="facility" id="facility" class="form-control">
                                        <?php foreach ($facilities as $facility): ?>
                                            <option value="<?= $facility['id'] ?>" data-capacity="<?= $facility['capacity'] ?>"><?= $facility['name'] ?> (<?= ucfirst($facility['type']) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="capacity">Capacity</label>
                                    <input type="number" id="capacity" class="form-control" readonly>
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
            $("#facility").on("change", function() {

                let capacity = $(this).find(":selected").data("capacity");
                $("#capacity").val(capacity);
                let $container = $("#facility-fields");
                $container.empty();

                if (capacity > 0) {
                    for (let i = 1; i <= capacity; i++) {
                        let fieldGroup = `
                        <div class="col-12 col-md-4"> 
                            <label>Guest ${i}</label>
                            <input type="text" name="persons[${i}][guest_name]" class="form-control" placeholder="Enter name">
                        </div> 
                        <div class="col-12 col-md-4">
                            <label>Age</label>
                            <input type="number" name="persons[${i}][guest_age]" class="form-control" placeholder="Enter age">
                        </div>
                        <div class="col-12 col-md-4">
                            <label>Type</label>
                            <select name="persons[${i}][guest_type]" class="form-control">
                                <?php foreach (\Http\Enums\GuestType::toArray() as $type): ?>
                                    <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        `;
                        $container.append(fieldGroup);
                    }
                }
            });

            // Trigger once on page load if a facility is already selected
            $("#facility").trigger("change");
        });
    </script>

</body>

</html>