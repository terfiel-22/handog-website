<?php
$pageName = "Edit User"
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
                    <form class="row gy-3" method="POST" action="/admin/users/update">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $user["id"] ?>">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" value="<?= $user['username'] ?>">
                            <?php if (isset($errors["username"])) : ?>
                                <div class="error-text">
                                    <?= $errors["username"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="<?= $user['email'] ?>">
                            <?php if (isset($errors["email"])) : ?>
                                <div class="error-text">
                                    <?= $errors["email"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="type">Account Type</label>
                            <select name="type" id="type" class="form-control">
                                <?php foreach (\Http\Enums\UserType::toArray() as $type): ?>
                                    <option value="<?= $type ?>" <?= $user['type'] == $type ? "selected" : "" ?>> <?= ucfirst($type) ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors["type"])) : ?>
                                <div class="error-text">
                                    <?= $errors["type"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" value="<?= old('password') ?>">
                            <?php if (isset($errors["password"])) : ?>
                                <div class="error-text">
                                    <?= $errors["password"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="cpassword">Confirm Password</label>
                            <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Retype the password" value="<?= old('cpassword') ?>">
                            <?php if (isset($errors["cpassword"])) : ?>
                                <div class="error-text">
                                    <?= $errors["cpassword"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 g-5">
                            <a href="/admin/users" class="btn btn-danger-600">Cancel</a>
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