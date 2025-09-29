<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Amenities"
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
        'pageName' => "Amenities"
    ]) ?>

    <!-- GT Pool Section Start -->
    <section class="gt-why-choose-us-section-2 section-padding fix">
        <div class="gt-choose-us-shape">
            <img src="/assets/guest/img/home-2/choose-us/Vector-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Dive into relaxation
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Pools
                    </h2>
                </div>
            </div>
            <div class="row">
                <?php foreach ($pools as $pool): ?>
                    <div
                        class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp"
                        data-wow-delay=".3s">
                        <div class="gt-why-choose-us-images">
                            <div class="gt-choose-us-image">
                                <img
                                    src="<?= handleImage($pool["image"], "/assets/guest/img/home-2/choose-us/choose-us-01.jpg")  ?>"
                                    alt="<?= $pool["name"] ?>"
                                    class="fixed-height-img" />
                                <div class="gt-content">
                                    <h3><?= $pool["name"] ?></h3>
                                    <p>
                                        <?= $pool["description"] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- GT Grillers Section Start -->
    <section class="gt-service-section fix section-padding section-bg-3">
        <div class="left-shape">
            <img src="/assets/guest/img/home-3/service/left-shape.png" alt="img">
        </div>
        <div class="container">
            <div class="gt-service-wrapper-3">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="service-content">
                            <div class="gt-section-title mb-0">
                                <h6 class="wow fadeInUp">
                                    <img src="/assets/guest/img/sub-left.svg" alt="img">
                                    Perfect for outdoor feasts
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    <?= $griller["name"] ?>
                                </h2>
                            </div>
                            <p class="service-text wow fadeInUp" data-wow-delay=".4s">
                                <?= $griller["description"] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="swiper service-image-slider">
                            <div class="swiper-wrapper">
                                <?php
                                $grillerImages = explode(",", $griller["images"]);
                                foreach ($grillerImages as $grillerImage):
                                ?>
                                    <div class="swiper-slide">
                                        <div class="service-image">
                                            <img src="<?= handleImage($grillerImage, "/assets/guest/img/home-3/service/service-01.jpg") ?>" alt="<?= $griller["name"] ?>">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="array-button-2 justify-content-center">
                                <button class="array-next"><i class="fa-solid fa-chevron-left"></i></button>

                                <button class="array-prev"><i class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Shower room Section Start -->
    <section class="gt-service-section fix section-padding">
        <div class="left-shape">
            <img src="/assets/guest/img/home-3/service/left-shape.png" alt="img">
        </div>
        <div class="container">
            <div class="gt-service-wrapper-3">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="swiper service-image-slider">
                            <div class="swiper-wrapper">
                                <?php
                                $showerImages = explode(",", $shower["images"]);
                                foreach ($showerImages as $showerImage):
                                ?>
                                    <div class="swiper-slide">
                                        <div class="service-image">
                                            <img src="<?= handleImage($showerImage, "/assets/guest/img/home-3/service/service-01.jpg") ?>" alt="<?= $shower["name"] ?>">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="array-button-2 justify-content-center">
                                <button class="array-next"><i class="fa-solid fa-chevron-left"></i></button>

                                <button class="array-prev"><i class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="service-content">
                            <div class="gt-section-title mb-0">
                                <h6 class="wow fadeInUp">
                                    <img src="/assets/guest/img/sub-left.svg" alt="img">
                                    Refresh and recharge
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    <?= $shower["name"] ?>
                                </h2>
                            </div>
                            <p class="service-text wow fadeInUp" data-wow-delay=".4s">
                                <?= $shower["description"] ?>
                            </p>
                        </div>
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