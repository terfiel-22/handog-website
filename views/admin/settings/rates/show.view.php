<?php
$pageName = "Rates"
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

            <!-- Data -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Modify Rates</h6>
                </div>

                <div class="card-body">
                    <form class="row gy-3" method="POST" action="#">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="adult_rate_day">Adult Rate (Day)</label>
                            <input type="number" name="adult_rate_day" id="adult_rate_day" class="form-control" placeholder="Enter Adult Entrance Rate (Day)">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="adult_rate_night">Adult Rate (Night)</label>
                            <input type="number" name="adult_rate_night" id="adult_rate_night" class="form-control" placeholder="Enter Adult Entrance Rate (Night)">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="kid_rate_day">Kid Rate (Day)</label>
                            <input type="number" name="kid_rate_day" id="kid_rate_day" class="form-control" placeholder="Enter Kid Entrance Rate (Day)">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="kid_rate_night">Kid Rate (Night)</label>
                            <input type="number" name="kid_rate_night" id="kid_rate_night" class="form-control" placeholder="Enter Kid Entrance Rate (Night)">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="senior_pwd_discount">Senior/PWD Discount (%)</label>
                            <input type="number" name="senior_pwd_discount" id="senior_pwd_discount" class="form-control" placeholder="Enter Senior/PWD Discount (%)">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="videoke_rent">Videoke Rent</label>
                            <input type="number" name="videoke_rent" id="videoke_rent" class="form-control" placeholder="Enter Videoke Rent Rate">
                        </div>
                        <div class="col-12 g-5">
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