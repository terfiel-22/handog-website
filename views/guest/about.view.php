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

    <!-- GT About Section Start -->
    <section class="gt-about-section-2 section-padding fix section-bg-3">
        <div class="gt-about-shape">
            <img src="/assets/guest/img/home-2/about/shape-01.png" alt="img">
        </div>
        <div class="container">
            <div class="gt-about-wrapper-2">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <div class="gt-about-left-content">
                            <div class="gt-section-title">
                                <h6 class="wow fadeInUp">
                                    <img src="/assets/guest/img/arrow-left.svg" alt="img">
                                    About Us
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    Welcome to our resort and hotel, Arlux
                                </h2>
                            </div>
                            <div class="gt-about-box-items">
                                <div class="wow fadeInUp" data-wow-delay=".6s">
                                    <div class="about-content-icon">
                                        <div class="gt-icon-box">
                                            <div class="content">
                                                <h3>History</h3>
                                                <p>Handog Resort was established in 2024 as a family-owned getaway spot. What started as a small retreat for close friends and family has now grown into a full-service resort offering cottages, rooms, pools, and event spaces. Over the years, we have welcomed countless guests—families, friends, and organizations—who continue to make lasting memories with us. With every improvement and expansion, we remain committed to our goal: creating a place where relaxation meets adventure.</p>
                                            </div>
                                        </div>
                                        <div class="gt-icon-box">
                                            <div class="content">
                                                <h3>Our Mission</h3>
                                                <p>Our mission is to provide every guest with exceptional service, safe and comfortable accommodations, and memorable recreational activities, while promoting sustainability and preserving the beauty of our surroundings.</p>
                                            </div>
                                        </div>
                                        <div class="gt-icon-box style-2">
                                            <div class="content">
                                                <h3>Our Vision</h3>
                                                <p>To be the premier destination resort that offers unforgettable experiences, blending relaxation, adventure, and Filipino hospitality in a serene natural environment.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 wow fadeInUp" data-wow-delay=".5s">
                        <div class="gt-about-right-image">
                            <div class="gt-about-image">
                                <img src="/assets/guest/img/home-2/about/02.jpg" alt="img">
                                <div class="gt-counter-box">
                                    <h2><span class="gt-count">79</span>+</h2>
                                    <h4>BIG SUITES</h4>
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