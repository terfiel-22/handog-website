<?php
$pageName = "Add Promo"
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
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0"><?= $pageName ?></h6>
                </div>

                <div class="card-body">
                    <form class="row gy-3" method="POST" action="/admin/promos/store">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter promo title" value="<?= old('title') ?>">
                            <?php if (isset($errors["title"])) : ?>
                                <div class="error-text">
                                    <?= $errors["title"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="discount_value">Discount Value</label>
                            <input type="number" name="discount_value" id="discount_value" class="form-control" placeholder="Enter promo discount_value" value="<?= old('discount_value') ?>">
                            <?php if (isset($errors["discount_value"])) : ?>
                                <div class="error-text">
                                    <?= $errors["discount_value"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter promo description"><?= old('description') ?></textarea>
                            <?php if (isset($errors["description"])) : ?>
                                <div class="error-text">
                                    <?= $errors["description"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="start_date">Start Date</label>
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Enter promo start date" value="<?= old('start_date') ?>">
                            <?php if (isset($errors["start_date"])) : ?>
                                <div class="error-text">
                                    <?= $errors["start_date"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="end_date">End Date</label>
                            <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Enter promo end date" value="<?= old('end_date') ?>">
                            <?php if (isset($errors["end_date"])) : ?>
                                <div class="error-text">
                                    <?= $errors["end_date"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="facility_type">Applicable To</label>
                            <select name="facility_types[]" id="facility_type" class="multi-select form-select" multiple="multiple">
                                <?php foreach ($facilities as $facility): ?>
                                    <option value="<?= $facility["id"] ?>" <?= old('facility_type') == $facility ? "selected" : "" ?>><?= ucfirst($facility["name"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors["facility_type"])) : ?>
                                <div class="error-text">
                                    <?= $errors["facility_type"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="is_active">Is Active</label>
                            <select name="is_active" id="is_active" class="form-select">
                                <?php foreach (\Http\Enums\YesNo::toArray() as $is_active): ?>
                                    <option value="<?= $is_active ?>" <?= old('is_active') == $is_active ? "selected" : "" ?>><?= ucfirst($is_active) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors["is_active"])) : ?>
                                <div class="error-text">
                                    <?= $errors["is_active"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 g-5">
                            <a href="/admin/promos" class="btn btn-danger-600">Cancel</a>
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <!-- Date Picker -->
    <script>
        $(function() {
            $('#start_date, #end_date').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today"
            });
        });
    </script>

    <!-- Multiple Select -->
    <script>
        $(document).ready(function() {
            $('.multi-select').select2({
                placeholder: 'Select facility type/s',
                theme: 'bootstrap-5',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            });
        });
    </script>
</body>

</html>