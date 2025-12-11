<?php
$pageName = "Password Setup"
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
                    <h4 class="mb-12">Set Up Your Password</h4>
                    <p class="mb-32 text-secondary-light text-lg">Create a secure password to activate your new staff account.</p>
                </div>
                <form method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-20">
                        <div class="position-relative">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                </span>
                                <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" name="password" id="password" value="<?= old('password') ?>" placeholder="Enter New Password">
                            </div>
                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#password"></span>
                        </div>
                        <?php if (isset($errors["password"])) : ?>
                            <div class="error-text">
                                <?= $errors["password"] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-20">
                        <div class="position-relative">
                            <div class="icon-field">
                                <span class="icon top-50 translate-middle-y">
                                    <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                                </span>
                                <input type="password" class="form-control h-56-px bg-neutral-50 radius-12" name="cpassword" id="cpassword" value="<?= old('cpassword') ?>" placeholder="Confirm Password">
                            </div>
                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#cpassword"></span>
                        </div>
                        <?php if (isset($errors["cpassword"])) : ?>
                            <div class="error-text">
                                <?= $errors["cpassword"] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Password</button>

                    <div class="text-center">
                        <a href="/admin" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>
    <script>
        $(document).ready(function() {
            // ================== Password Show Hide Js Start ==========
            function initializePasswordToggle(toggleSelector) {
                $(toggleSelector).on('click', function() {
                    $(this).toggleClass("ri-eye-off-line");
                    var input = $($(this).attr("data-toggle"));
                    if (input.attr("type") === "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            }
            // Call the function
            initializePasswordToggle('.toggle-password');
            // ========================= Password Show Hide Js End ===========================
        });
    </script>

</body>

</html>