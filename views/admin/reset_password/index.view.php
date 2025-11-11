<?php
$pageName = "Forgot Password"
?>

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<!-- Head Tag -->
<?php view("admin/partials/head.partial.php", [
    'title' => "Handog Admin | " . $pageName
]) ?>

<body>

    <section class="auth bg-base d-flex flex-wrap">
        <div class="auth-left d-lg-block d-none">
            <div class="d-flex align-items-center flex-column h-100 justify-content-center">
                <img src="/assets/admin/images/auth/auth-img.png" alt="">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <a href="/admin" class="mb-40 max-w-290-px">

                        <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo()["logo"], "/assets/admin/images/logo.png") ?>" alt="site logo">
                    </a>
                    <h4 class="mb-12">Forgot Password</h4>
                    <p class="mb-32 text-secondary-light text-lg">Enter the email address associated with your account and we will send you a link to reset your password.</p>
                </div>
                <form method="POST">
                    <div class="mb-16">
                        <div class="icon-field">
                            <span class="icon top-50 translate-middle-y">
                                <iconify-icon icon="mage:email"></iconify-icon>
                            </span>
                            <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" name="email" placeholder="Email" value="<?= old("email") ?>">
                        </div>
                        <?php if (isset($errors["email"])) : ?>
                            <div class="error-text">
                                <?= $errors["email"] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32" data-bs-toggle="modal" data-bs-target="#exampleModal">Continue</button>

                    <div class="text-center">
                        <a href="/admin" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

</body>

</html>