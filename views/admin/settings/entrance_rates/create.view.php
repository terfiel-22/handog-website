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
                            <label class="form-label" for="start_time">Start Time</label>
                            <input type="time" name="start_time" id="start_time" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="end_time">End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="guest_type">Guest Type</label>
                            <select name="guest_type" id="guest_type" class="form-control">
                                <?php foreach (\Http\Enums\GuestType::toArray() as $type): ?>
                                    <option value="<?= $type ?>"><?= $type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="rate">Rate</label>
                            <input type="number" name="rate" id="rate" class="form-control" placeholder="Enter Entrance Rate">
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