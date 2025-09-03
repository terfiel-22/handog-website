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
                                <h3>Enjoy the Adult Pool</h3>
                                <p>
                                    Take a refreshing dip in our adult pool,
                                    designed for relaxation and recreation.
                                    With ample space for swimming and
                                    lounging, it's the perfect spot to soak up
                                    the sun and enjoy a leisurely afternoon.
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
                                <h3>Fun for the Little Ones</h3>
                                <p>
                                    Our kiddie pool is designed with safety
                                    and fun in mind. With shallow water and
                                    fountain, it&apos;s a perfect place for out little
                                    ones to splash and play.
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
                                <h3>Relax in Our Jacuzzi</h3>
                                <p>
                                    Indulge in the soothing warmth of our
                                    jacuzzi. Perfect for unwinding after a long
                                    day, it offers a tranquil escape with its
                                    massaging jets and serene ambiance.
                                    Experience pure bliss as you let your
                                    worries melt away.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Instagram Section Start -->
    <section class="gt-instagram-section fix">
        <div class="gt-instagram-wrapper-2">
            <div class="swiper gt-instagram-slider-2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="gt-instagram-image mt-0">
                            <img src="/assets/guest/img/home-2/instagram/01.jpg" alt="img" />
                            <a href="index.html" class="gt-icon">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gt-instagram-image mt-0">
                            <img src="/assets/guest/img/home-2/instagram/02.jpg" alt="img" />
                            <a href="index.html" class="gt-icon">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gt-instagram-image mt-0">
                            <img src="/assets/guest/img/home-2/instagram/03.jpg" alt="img" />
                            <a href="index.html" class="gt-icon">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gt-instagram-image mt-0">
                            <img src="/assets/guest/img/home-2/instagram/04.jpg" alt="img" />
                            <a href="index.html" class="gt-icon">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gt-instagram-image mt-0">
                            <img src="/assets/guest/img/home-2/instagram/05.jpg" alt="img" />
                            <a href="index.html" class="gt-icon">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gt-instagram-image mt-0">
                            <img src="/assets/guest/img/home-2/instagram/06.jpg" alt="img" />
                            <a href="index.html" class="gt-icon">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gt-instagram-text-box">
                <div class="icon">
                    <i class="fa-brands fa-instagram"></i>
                </div>
                Follow Us On Instagram
            </div>
        </div>
    </section>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>
</body>

</html>