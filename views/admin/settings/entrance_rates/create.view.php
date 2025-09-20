<?php
$pageName = "Entrance Rates"
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
                    <h6 class="card-title mb-0">Add Entrance Rate</h6>
                </div>
                <div class="card-body">
                    <form class="row gy-3" method="POST" action="/admin/settings/entrance-rates/store">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="adult_rate">Adult Rate</label>
                            <input type="number" name="adult_rate" id="adult_rate" class="form-control" placeholder="Enter Adult Entrance Rate">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="kid_rate">Kid Rate</label>
                            <input type="number" name="kid_rate" id="kid_rate" class="form-control" placeholder="Enter Kid Entrance Rate">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="time_slot">Time Slot</label>
                            <select name="time_slot" id="time_slot" class="form-control">
                                <?php foreach (\Http\Enums\TimeSlot::toArray() as $timeSlot): ?>
                                    <option value="<?= $timeSlot ?>"><?= ucfirst($timeSlot) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="senior_pwd_discount">Senior/PWD Discount (%)</label>
                            <input type="number" name="senior_pwd_discount" id="senior_pwd_discount" class="form-control" placeholder="Enter Discount (%)">
                        </div>
                        <div class="col-12 g-5">
                            <a href="/admin/settings/entrance-rates" class="btn btn-danger-600">Cancel</a>
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

</body>

</html>