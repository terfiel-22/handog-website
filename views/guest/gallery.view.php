<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Gallery"
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
    <?php view("guest/partials/breadcrumb.partial.php", [
        'pageName' => "Gallery"
    ]) ?>

    <!-- GT Gallery Section Start -->
    <section class="gt-why-choose-us-section-2 section-padding fix">
        <div class="gt-choose-us-shape">
            <img src="/assets/guest/img/home-2/choose-us/Vector-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Discover the beauty that awaits
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Gallery
                    </h2>
                </div>
            </div>
            <div class="row g-3 wow fadeInUp">
                <?php foreach ($images as $image): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <img src="<?= handleFilePath($image["image"], "/assets/guest/img/home-2/choose-us/choose-us-01.jpg") ?>" class="img-fluid gallery-img clickable-img" alt="<?= $image["name"] ?>">
                        <h5 class="mt-2"><?= $image["name"] ?></h5>
                        <p class="text-muted small"><?= $image["description"] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>
</body>

</html>