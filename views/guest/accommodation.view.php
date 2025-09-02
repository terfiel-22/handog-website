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
                <div
                    class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp"
                    data-wow-delay=".3s">
                    <div class="gt-why-choose-us-images">
                        <div class="gt-choose-us-image">
                            <img
                                src="/assets/guest/img/home-2/choose-us/choose-us-01.jpg"
                                alt="img" />
                            <div class="gt-content">
                                <h3>Romantic Escapes</h3>
                                <p>
                                    Wake up to breathtaking ocean views in our elegant, serene,
                                    and beautifully
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp"
                    data-wow-delay=".5s">
                    <div class="gt-why-choose-us-images">
                        <div class="gt-choose-us-image">
                            <img
                                src="/assets/guest/img/home-2/choose-us/choose-us-02.jpg"
                                alt="img" />
                            <div class="gt-content">
                                <h3>Oceanfront Rooms</h3>
                                <p>
                                    Wake up to breathtaking ocean views in our elegant, serene,
                                    and beautifully
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp"
                    data-wow-delay=".7s">
                    <div class="gt-why-choose-us-images">
                        <div class="gt-choose-us-image">
                            <img
                                src="/assets/guest/img/home-2/choose-us/choose-us-03.jpg"
                                alt="img" />
                            <div class="gt-content">
                                <h3>Hotel Diner</h3>
                                <p>
                                    Wake up to breathtaking ocean views in our elegant, serene,
                                    and beautifully
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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
                <a
                    href="room.html"
                    class="gt-theme-btn wow fadeInUp"
                    data-wow-delay=".4s">VIEW DETAILS</a>
            </div>
            <div class="gt-room-explore-wrapper">
                <div class="swiper gt-room-explore-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div
                                class="gt-room-explore-items bg-cover"
                                style="
                    background-image: url('/assets/guest/img/home-2/room-explore/01.jpg');
                  ">
                                <div class="row justify-content-end">
                                    <div class="col-xl-5 col-lg-6">
                                        <div class="gt-room-exlore-box-items">
                                            <span class="gt-rate-title"> Rates From $120 </span>
                                            <h3>
                                                <a href="room-details.html">Presidential Beachfront Villa</a>
                                            </h3>
                                            <p>
                                                The pinnacle of seaside luxury—private pool, personal
                                                butler service, and breathtaking beachfront location.
                                            </p>
                                            <ul>
                                                <li>
                                                    <span>Capocity</span>
                                                    : 2 Persons
                                                </li>
                                                <li>
                                                    <span>Size</span>
                                                    : 80 sqr
                                                </li>
                                                <li>
                                                    <span>Bed</span>
                                                    : Kind Bed
                                                </li>
                                                <li>
                                                    <span>Services</span>
                                                    : Free Breakfast, Free Wifi, Free Water
                                                </li>
                                                <li>
                                                    <span>View</span>
                                                    : Dramatic City Views
                                                </li>
                                            </ul>
                                            <a href="room-details.html" class="gt-theme-btn">ROOM DETAILS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="gt-room-explore-items bg-cover"
                                style="
                    background-image: url('/assets/guest/img/home-2/room-explore/01.jpg');
                  ">
                                <div class="row justify-content-end">
                                    <div class="col-xl-5 col-lg-6">
                                        <div class="gt-room-exlore-box-items">
                                            <span class="gt-rate-title"> Rates From $120 </span>
                                            <h3>
                                                <a href="room-details.html">
                                                    Presidential Beachfront Villa</a>
                                            </h3>
                                            <p>
                                                The pinnacle of seaside luxury—private pool, personal
                                                butler service, and breathtaking beachfront location.
                                            </p>
                                            <ul>
                                                <li>
                                                    <span>Capocity</span>
                                                    : 2 Persons
                                                </li>
                                                <li>
                                                    <span>Size</span>
                                                    : 80 sqr
                                                </li>
                                                <li>
                                                    <span>Bed</span>
                                                    : Kind Bed
                                                </li>
                                                <li>
                                                    <span>Services</span>
                                                    : Free Breakfast, Free Wifi, Free Water
                                                </li>
                                                <li>
                                                    <span>View</span>
                                                    : Dramatic City Views
                                                </li>
                                            </ul>
                                            <a href="room-details.html" class="gt-theme-btn">ROOM DETAILS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div
                                class="gt-room-explore-items bg-cover"
                                style="
                    background-image: url('/assets/guest/img/home-2/room-explore/01.jpg');
                  ">
                                <div class="row justify-content-end">
                                    <div class="col-xl-5 col-lg-6">
                                        <div class="gt-room-exlore-box-items">
                                            <span class="gt-rate-title"> Rates From $120 </span>
                                            <h3>
                                                <a href="room-details.html">
                                                    Presidential Beachfront Villa</a>
                                            </h3>
                                            <p>
                                                The pinnacle of seaside luxury—private pool, personal
                                                butler service, and breathtaking beachfront location.
                                            </p>
                                            <ul>
                                                <li>
                                                    <span>Capocity</span>
                                                    : 2 Persons
                                                </li>
                                                <li>
                                                    <span>Size</span>
                                                    : 80 sqr
                                                </li>
                                                <li>
                                                    <span>Bed</span>
                                                    : Kind Bed
                                                </li>
                                                <li>
                                                    <span>Services</span>
                                                    : Free Breakfast, Free Wifi, Free Water
                                                </li>
                                                <li>
                                                    <span>View</span>
                                                    : Dramatic City Views
                                                </li>
                                            </ul>
                                            <a href="room-details.html" class="gt-theme-btn">ROOM DETAILS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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