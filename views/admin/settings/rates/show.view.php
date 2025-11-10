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
                    <form class="row gy-3" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $rates['id'] ?>">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="adult_rate_day">Adult Entrance Rate (Day)</label>
                            <input type="number" name="adult_rate_day" id="adult_rate_day" class="form-control" placeholder="Enter Adult Entrance Rate (Day)" value="<?= $rates['adult_rate_day'] ?>">
                            <?php if (isset($errors["adult_rate_day"])) : ?>
                                <div class="error-text">
                                    <?= $errors["adult_rate_day"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="adult_rate_night">Adult Entrance Rate (Night)</label>
                            <input type="number" name="adult_rate_night" id="adult_rate_night" class="form-control" placeholder="Enter Adult Entrance Rate (Night)" value="<?= $rates['adult_rate_night'] ?>">
                            <?php if (isset($errors["adult_rate_night"])) : ?>
                                <div class="error-text">
                                    <?= $errors["adult_rate_night"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="kid_rate_day">Kid Entrance Rate (Day)</label>
                            <input type="number" name="kid_rate_day" id="kid_rate_day" class="form-control" placeholder="Enter Kid Entrance Rate (Day)" value="<?= $rates['kid_rate_day'] ?>">
                            <?php if (isset($errors["kid_rate_day"])) : ?>
                                <div class="error-text">
                                    <?= $errors["kid_rate_day"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="kid_rate_night">Kid Entrance Rate (Night)</label>
                            <input type="number" name="kid_rate_night" id="kid_rate_night" class="form-control" placeholder="Enter Kid Entrance Rate (Night)" value="<?= $rates['kid_rate_night'] ?>">
                            <?php if (isset($errors["kid_rate_night"])) : ?>
                                <div class="error-text">
                                    <?= $errors["kid_rate_night"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="senior_pwd_discount">Senior/PWD Discount (%)</label>
                            <input type="number" name="senior_pwd_discount" id="senior_pwd_discount" class="form-control" placeholder="Enter Senior/PWD Discount (%)" value="<?= $rates['senior_pwd_discount'] * 100 ?>">
                            <?php if (isset($errors["senior_pwd_discount"])) : ?>
                                <div class="error-text">
                                    <?= $errors["senior_pwd_discount"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="videoke_rent">Videoke Rent</label>
                            <input type="number" name="videoke_rent" id="videoke_rent" class="form-control" placeholder="Enter Videoke Rent Rate" value="<?= $rates['videoke_rent'] ?>">
                            <?php if (isset($errors["videoke_rent"])) : ?>
                                <div class="error-text">
                                    <?= $errors["videoke_rent"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="additional_bed_rate">Additional Bed Rate</label>
                            <input type="number" name="additional_bed_rate" id="additional_bed_rate" class="form-control" placeholder="Enter Additional Bed Rate" value="<?= $rates['additional_bed_rate'] ?>">
                            <?php if (isset($errors["additional_bed_rate"])) : ?>
                                <div class="error-text">
                                    <?= $errors["additional_bed_rate"] ?>
                                </div>
                            <?php endif; ?>
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