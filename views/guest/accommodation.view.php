<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Accommodation"
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
        'pageName' => "Accommodation"
    ]) ?>

    <!-- GT Cottages Section Start -->
    <section class="gt-why-choose-us-section-2 section-padding fix">
        <div class="gt-choose-us-shape">
            <img src="/assets/guest/img/home-2/choose-us/Vector-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Cozy stays
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Cottages
                    </h2>
                </div>
                <a
                    href="/"
                    class="gt-theme-btn wow fadeInUp"
                    data-wow-delay=".4s">BOOK NOW</a>
            </div>
            <div class="row">
                <?php foreach ($cottages as $cottage): ?>
                    <div
                        class="col wow fadeInUp"
                        data-wow-delay=".3s">
                        <div class="gt-why-choose-us-images">
                            <div class="gt-choose-us-image">
                                <img
                                    src="<?= handleImage($cottage["image"], "/assets/guest/img/home-2/choose-us/choose-us-01.jpg") ?>"
                                    alt="<?= $cottage["name"] ?>"
                                    class="fixed-height-img" />
                                <div class="gt-content">
                                    <h3><?= $cottage["name"] ?></h3>
                                    <p>
                                        <?= $cottage["description"] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- GT Room Explore Section Start -->
    <section
        class="room-explore-section-2 section-padding fix bg-cover"
        style="
        background-image: url('/assets/guest/img/home-2/room-explore/explore-bg.png');
      ">
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Explore
                    </h6>
                    <h2 class="text-white fadeInUp" data-wow-delay=".2s">
                        Rooms
                    </h2>
                </div>
            </div>
            <div class="gt-room-explore-wrapper">
                <div class="swiper gt-room-explore-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($rooms as $room): ?>
                            <div class="swiper-slide">
                                <div
                                    class="gt-room-explore-items bg-cover h-40"
                                    style=" background-image: url('<?= handleImage($room['image'], "/assets/guest/img/home-2/room-explore/01.jpg") ?>');">
                                    <div class="row justify-content-end">
                                        <div class="col-xl-5 col-lg-6">
                                            <div class="gt-room-exlore-box-items">
                                                <span class="gt-rate-title"> Rates From <?= moneyFormat($room['rate_12hrs']) ?> </span>
                                                <h3>
                                                    <a href="/facility?id=<?= $room['id'] ?>"><?= $room['name'] ?></a>
                                                </h3>
                                                <p>
                                                    <?= $room['description'] ?>
                                                </p>
                                                <ul>
                                                    <li>
                                                        <span>Capacity</span>
                                                        : <?= $room['capacity'] ?> Persons
                                                    </li>
                                                    <li>
                                                        <span>Amenities</span>
                                                        : <?= $room['amenities'] ?>
                                                    </li>
                                                </ul>
                                                <a href="/facility?id=<?= $room['id'] ?>" class="gt-theme-btn">ROOM DETAILS</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Event Hall Section Start -->
    <section class="gt-service-section fix section-padding">
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
                                    A Space for Every Occasion
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    <?= $eventHall["name"] ?>
                                </h2>
                            </div>
                            <p class="service-text wow fadeInUp" data-wow-delay=".4s">
                                <?= $eventHall["description"] ?>
                            </p>
                            <a href="/" class="gt-theme-btn wow fadeInUp" data-wow-delay=".9s">LEARN MORE</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="swiper service-image-slider">
                            <div class="swiper-wrapper">
                                <?php
                                $eventHallImages = explode(",", $eventHall["images"]);
                                foreach ($eventHallImages as $eventHallImage):
                                ?>
                                    <div class="swiper-slide">
                                        <div class="service-image">
                                            <img src="<?= handleImage($eventHallImage, "/assets/guest/img/home-3/service/service-01.jpg") ?>" alt="img">
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

    <!-- GT Exclusive Section Start -->
    <section class="gt-service-section fix section-padding section-bg-3">
        <div class="left-shape">
            <img src="/assets/guest/img/home-3/service/left-shape.png" alt="img">
        </div>
        <div class="container">
            <div class="gt-service-wrapper-3">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="swiper service-image-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="service-image">
                                        <img src="/assets/guest/img/home-3/service/service-01.jpg" alt="img">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="service-image">
                                        <img src="/assets/guest/img/home-3/service/service-01.jpg" alt="img">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="service-image">
                                        <img src="/assets/guest/img/home-3/service/service-01.jpg" alt="img">
                                    </div>
                                </div>
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
                                    Privacy Beyond Compare
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    Exclusive
                                </h2>
                            </div>
                            <p class="service-text wow fadeInUp" data-wow-delay=".4s">
                                Make the entire resort your own private paradise!
                                With our exclusive reservation package, you get full,
                                private access to all our amenities. Perfect for
                                reunions, celebrations, or peaceful getaways. No
                                crowds, no interruptions just you and your loved ones
                                enjoying the moment.
                            </p>
                            <div class="wow fadeInUp" data-wow-delay=".5s">
                                <h3>
                                    What&apos;s included in your exclusive reservation?
                                </h3>
                                <ul class="check-list">
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Swimming pool
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Cottages
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        3 Standard Rooms (ideal for solo guests or couples)
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        1 Family Room (perfect for 2 to 4 guests)
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Event hall
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Sound System
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Open relaxing spaces and resort grounds
                                    </li>
                                </ul>
                            </div>
                            <div class="wow fadeInUp my-2" data-wow-delay=".6s">
                                <h3>
                                    How much does it cost to rent the entire resort?
                                </h3>
                                <ul class="check-list">
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        55,000 Pesos for 12 hrs
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        80,000 pesos for 24 hrs
                                    </li>
                                </ul>
                            </div>
                            <a href="/" class="gt-theme-btn wow fadeInUp" data-wow-delay=".9s">BOOK NOW</a>
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