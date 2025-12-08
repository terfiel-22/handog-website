<?php
$pageName = "Contact Details"
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
                <div class="card-header pb-0">
                    <h6 class="card-title mb-0">Modify <?= $pageName ?></h6>
                    <p class="text-secondary small">Fields marked with an asterisk (*) are required.</p>
                </div>

                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                        <div class="row gy-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="facebook">Facebook Link *</label>
                                <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Enter Facebook Link" value="<?= old('facebook', $contact['facebook']) ?>">
                                <?php if (isset($errors["facebook"])) : ?>
                                    <div class="error-text">
                                        <?= $errors["facebook"] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="instagram">Instagram Link *</label>
                                <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Enter Instagram Link" value="<?= old('instagram', $contact['instagram']) ?>">
                                <?php if (isset($errors["instagram"])) : ?>
                                    <div class="error-text">
                                        <?= $errors["instagram"] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="email">Website Email *</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Website Email" value="<?= old('email', $contact['email']) ?>">
                                <?php if (isset($errors["email"])) : ?>
                                    <div class="error-text">
                                        <?= $errors["email"] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="contact_no">Contact Number *</label>
                                <input type="tel" name="contact_no" id="contact_no" class="form-control" placeholder="Enter Contact Number" value="<?= old('contact_no', $contact['contact_no']) ?>">
                                <?php if (isset($errors["contact_no"])) : ?>
                                    <div class="error-text">
                                        <?= $errors["contact_no"] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="address">Address *</label>
                                <textarea name="address" id="address" class="form-control" placeholder="Enter Address"><?= old('address', $contact['address']) ?></textarea>
                                <?php if (isset($errors["address"])) : ?>
                                    <div class="error-text">
                                        <?= $errors["address"] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
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