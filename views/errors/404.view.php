<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | About Us"
]) ?>

<body>
    <!-- Preloader Start -->
    <?php view("guest/partials/preloader.partial.php") ?>

    <!-- Misc Section -->
    <?php view("guest/partials/misc.partial.php") ?>

    <!-- Offcanvas Area Start -->
    <?php view("guest/partials/off_canvas.partial.php") ?>

    <!-- Header Section Start -->
    <?php view("guest/partials/header.partial.php") ?>

    <!-- Breadcrumb Section Start -->
    <div class="gt-breadcrumb-wrapper bg-cover" style="background-image: url('/assets/guest/img/breadcrumb.jpg');">
        <div class="breadcrumb-shape">
            <img src="/assets/guest/img/bottom-shape2.png" alt="img">
        </div>
        <div class="container">
            <div class="gt-page-heading">
                <div class="gt-breadcrumb-sub-title">
                    <h1 class=" text-white wow fadeInUp" data-wow-delay=".3s">404 Error Page</h1>
                </div>
                <ul class="gt-breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right"></i>
                    </li>
                    <li>
                        404 Error Page
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- GT Error Section Start -->
    <section class="gt-error-section section-padding fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="gt-error-items">
                        <div class="gt-error-image wow fadeInUp" data-wow-delay=".3s">
                            <img src="/assets/guest/img/inner/404.png" alt="img">
                        </div>
                        <h2 class="wow fadeInUp" data-wow-delay=".5s">
                            Oops! Page Not Found!
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".3s">
                            There is no page that you are looking for. It may have been erased or moved.
                        </p>
                        <a href="/" class=" gt-theme-btn wow fadeInUp" data-wow-delay=".5s">
                            BACK TO HOME
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>
</body>

</html>