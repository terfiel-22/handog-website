<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog"
]) ?>

<body>
    <!-- Preloader Start -->
    <?php view("guest/partials/preloader.partial.php") ?>

    <!-- Misc Section -->
    <?php view("guest/partials/misc.partial.php") ?>

    <!-- Offcanvas Area Start -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div
                        class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="index.html">
                                <img src="/assets/guest/img/logo/black-logo.svg" alt="logo-img" />
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text d-none d-xl-block">
                        Nullam dignissim, ante scelerisque the is euismod fermentum odio
                        sem semper the is erat, a feugiat leo urna eget eros. Duis Aenean
                        a imperdiet risus.
                    </p>
                    <div class="mobile-menu fix mb-3"></div>
                    <div class="offcanvas__contact">
                        <h4>Contact Info</h4>
                        <ul>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="#">Main Street, Melbourne, Australia</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="mailto:info@example.com"><span class="mailto:info@example.com">info@example.com</span></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="#">Mod-friday, 09am -05pm</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="far fa-phone"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:+11002345909">+11002345909</a>
                                </div>
                            </li>
                        </ul>
                        <div class="header-button mt-4"></div>
                        <a href="contact.html" class="gt-theme-btn">BOOK NOW</a>
                        <div class="social-icon d-flex align-items-center">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>

    <!-- Header Section Start -->
    <header id="header-sticky" class="header-1 header-2">
        <div class="container-fluid">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="index.html" class="header-logo">
                            <img src="/assets/guest/img/logo/white-logo.svg" alt="logo-img" />
                        </a>
                        <a href="index.html" class="header-logo-2">
                            <img src="/assets/guest/img/logo/black-logo.svg" alt="logo-img" />
                        </a>
                    </div>
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="has-dropdown active menu-thumb">
                                        <a href="index.html"> Home </a>
                                        <ul class="submenu has-homemenu">
                                            <li>
                                                <div class="homemenu-items">
                                                    <div class="homemenu">
                                                        <div class="homemenu-thumb">
                                                            <img
                                                                src="/assets/guest/img/header/home-01.jpg"
                                                                alt="img" />
                                                            <div class="demo-button">
                                                                <a href="index.html" class="gt-theme-btn">Demo page</a>
                                                            </div>
                                                        </div>
                                                        <div class="homemenu-content text-center">
                                                            <h4 class="homemenu-title">Luxery Hotel</h4>
                                                        </div>
                                                    </div>
                                                    <div class="homemenu">
                                                        <div class="homemenu-thumb mb-15">
                                                            <img
                                                                src="/assets/guest/img/header/home-02.jpg"
                                                                alt="img" />
                                                            <div class="demo-button">
                                                                <a href="index-2.html" class="gt-theme-btn">Demo page</a>
                                                            </div>
                                                        </div>
                                                        <div class="homemenu-content text-center">
                                                            <h4 class="homemenu-title">Beach Hotel</h4>
                                                        </div>
                                                    </div>
                                                    <div class="homemenu">
                                                        <div class="homemenu-thumb mb-15">
                                                            <img
                                                                src="/assets/guest/img/header/home-03.jpg"
                                                                alt="img" />
                                                            <div class="demo-button">
                                                                <a href="index-3.html" class="gt-theme-btn">Demo page</a>
                                                            </div>
                                                        </div>
                                                        <div class="homemenu-content text-center">
                                                            <h4 class="homemenu-title">City Hotel</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown active d-xl-none">
                                        <a href="index.html" class="border-none"> Home </a>
                                        <ul class="submenu">
                                            <li><a href="index.html">Luxery Hote</a></li>
                                            <li><a href="index-2.html">Beach Hotel</a></li>
                                            <li><a href="index-3.html">City Hotel</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="news.html"> Pages </a>
                                        <ul class="submenu">
                                            <li><a href="about.html">About Us</a></li>
                                            <li class="has-dropdown">
                                                <a href="team-details.html">
                                                    Our Team
                                                    <i class="fas fa-angle-right"></i>
                                                </a>
                                                <ul class="submenu">
                                                    <li><a href="team.html">Our Team</a></li>
                                                    <li>
                                                        <a href="team-details.html">Team Details</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="restaurant.html">Restaurant</a></li>
                                            <li><a href="testimonial.html">Our Testimonial</a></li>
                                            <li><a href="404.html">404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="service-details.html"> Services </a>
                                        <ul class="submenu">
                                            <li><a href="service.html">Service Page</a></li>
                                            <li>
                                                <a href="service-details.html">Service Details</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="room-details.html"> Room </a>
                                        <ul class="submenu">
                                            <li><a href="room.html">Room 01 Page</a></li>
                                            <li><a href="room-2.html">Room 02 Page</a></li>
                                            <li><a href="room-details.html">Room Details</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="news-details.html"> Blog </a>
                                        <ul class="submenu">
                                            <li><a href="news-grid.html">Blog Grid</a></li>
                                            <li><a href="news.html">Blog Standard</a></li>
                                            <li><a href="news-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div
                        class="header-right d-flex justify-content-end align-items-center">
                        <div class="header__hamburger my-auto">
                            <div class="sidebar__toggle">
                                <div class="header-bar">
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="hero-button">
                            <a href="contact.html" class="gt-theme-btn">BOOKING ONLINE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- GT Hero Section Start -->
    <section
        class="gt-hero-section gt-hero-2 parallaxie fix bg-cover"
        style="background-image: url('/assets/guest/img/home-2/hero/hero-01.jpg')">
        <div class="hero-shape-bottom">
            <img src="/assets/guest/img/home-2/hero/hero-Vector.png" alt="img" />
        </div>
        <div class="social-icon d-flex align-items-center">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <span>Fallow Us:</span>
        </div>
        <div class="hero-shape-right">
            <img src="/assets/guest/img/home-2/hero/Vector-right.png" alt="img" />
        </div>
        <ul class="hero-contact">
            <li>
                <img src="/assets/guest/img/home-1/footer/location.svg" alt="img" />
                <a href="mailto:info@example.com">
                    Tuesday - Saturday 8:00 Am - 11:00 Pm</a>
            </li>
            <li>
                <img src="/assets/guest/img/home-1/footer/email.svg" alt="img" />
                <a href="mailto:info@example.com"> info@example.com</a>
            </li>
        </ul>
        <div class="container">
            <div class="gt-hero-content text-center">
                <span class="wow fadeInUp"><img src="/assets/guest/img/sub-left.svg" alt="img" /> Our Seaside Retreat
                    Is Stunning <img src="/assets/guest/img/sub-right.svg" alt="img" /></span>
                <h1 class="text-white wow fadeInUp" data-wow-delay=".2s">
                    Explore the Magnificence of Our Beach Haven
                </h1>
                <p class="text-white mt-3 wow fadeInUp" data-wow-delay=".4s">
                    Discover a sanctuary where sun-kissed shores meet timeless elegance.
                    Nestled along pristine coastline, our Beach Haven offers a serene
                    escape infused with luxurious comfort and breathtaking natural
                    beauty.
                </p>
                <div class="gt-hero-button wow fadeInUp" data-wow-delay=".6s">
                    <a href="room.html" class="gt-theme-btn">DISCOVER ROOM</a>
                    <a href="contact.html" class="gt-theme-btn style-2">Book Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- GT About Section Start -->
    <section class="gt-about-section-2 section-padding fix section-bg-3">
        <div class="gt-about-shape">
            <img src="/assets/guest/img/home-2/about/shape-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-about-wrapper-2">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="gt-about-left-content">
                            <div class="gt-section-title">
                                <h6 class="wow fadeInUp">
                                    <img src="/assets/guest/img/sub-left.svg" alt="img" />
                                    About Us
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    Welcome to our resort and hotel, Arlux
                                </h2>
                            </div>
                            <div class="gt-about-box-items">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 wow fadeInUp" data-wow-delay=".4s">
                                        <div class="gt-about-images">
                                            <img src="/assets/guest/img/home-2/about/01.jpg" alt="img" />
                                            <span class="title-box">
                                                <img
                                                    src="/assets/guest/img/home-2/about/tir-vector.png"
                                                    alt="img" />
                                                SINCE 2007
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 wow fadeInUp" data-wow-delay=".6s">
                                        <div class="about-content-icon">
                                            <div class="gt-icon-box">
                                                <div class="icon">
                                                    <i class="flaticon-target"></i>
                                                </div>
                                                <div class="content">
                                                    <h3>Our Mission</h3>
                                                    <p>
                                                        Discover a sanctuary where sun-kissed shores meet
                                                        timeless elegance.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="gt-icon-box style-2">
                                                <div class="icon">
                                                    <i class="flaticon-leadership"></i>
                                                </div>
                                                <div class="content">
                                                    <h3>Our Vission</h3>
                                                    <p>
                                                        Our Beach Haven offers a serene escape infused
                                                        with luxurious comfort
                                                    </p>
                                                </div>
                                            </div>
                                            <a href="about.html" class="gt-theme-btn">DISCOVER MORE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 wow fadeInUp" data-wow-delay=".5s">
                        <div class="gt-about-right-image">
                            <div class="gt-about-image">
                                <img src="/assets/guest/img/home-2/about/02.jpg" alt="img" />
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

    <!-- GT Why Choose Us Section Start -->
    <section class="gt-why-choose-us-section-2 section-padding fix">
        <div class="gt-choose-us-shape">
            <img src="/assets/guest/img/home-2/choose-us/Vector-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-section-title text-center">
                <h6 class="justify-content-center wow fadeInUp">
                    <img src="/assets/guest/img/sub-left.svg" alt="img" />
                    Facilities
                    <img src="/assets/guest/img/sub-right.svg" alt="img" />
                </h6>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">Why Choose Us</h2>
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
                        Rooms & Suites
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

    <!-- GT Hotel Facilities Section Start -->
    <section class="gt-hotel-facilities-section-2 section-padding fix">
        <div class="gt-hotel-facilities-shape">
            <img src="/assets/guest/img/home-2/hotel-facilites/Vector-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-hotel-facilities-wrapper-2">
                <div class="row g-4">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="gt-hotel-left-images">
                            <img src="/assets/guest/img/home-2/hotel-facilites/01.jpg" alt="img" />
                            <a
                                href="https://www.youtube.com/watch?v=Cn4G2lZ_g2I"
                                class="video-btn ripple video-popup">
                                <i class="fa-solid fa-play"></i>
                            </a>
                            <div class="gt-counter">
                                <h2><span class="gt-count">21</span>+</h2>
                                <p>
                                    Years Of <br />
                                    Experience
                                </p>
                            </div>
                            <div class="gt-hotel-img wow fadeInUp" data-wow-delay=".5s">
                                <img
                                    src="/assets/guest/img/home-2/hotel-facilites/02.jpg"
                                    alt="img" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="gt-hotel-right-content">
                            <div class="gt-section-title mb-0">
                                <h6 class="wow fadeInUp">
                                    <img src="/assets/guest/img/sub-left.svg" alt="img" />
                                    Hotel Facilities
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    The Framework
                                </h2>
                            </div>
                            <p class="gt-hotel-text wow fadeInUp" data-wow-delay=".4s">
                                The Framework blends modern luxury with timeless design,
                                offering sophisticated spaces, elegant details, and a serene
                                atmosphere crafted for unforgettable beachfront living and
                                elevated guest experiences.
                            </p>
                            <div class="gt-skill-feature-items">
                                <div
                                    class="gt-skill-feature wow fadeInUp"
                                    data-wow-delay=".3s">
                                    <h3 class="gt-box-title">Room Service</h3>
                                    <div class="gt-progress">
                                        <div
                                            class="gt-progress-bar"
                                            style="
                          width: 90%;
                          animation: 2.6s ease 0s 1 normal none running
                            animate-positive;
                          opacity: 1;
                        ">
                                            <div class="gt-progress-value">
                                                <span class="counter-number2">90</span>%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="gt-skill-feature wow fadeInUp"
                                    data-wow-delay=".4s">
                                    <h3 class="gt-box-title">Breakfast Included</h3>
                                    <div class="gt-progress">
                                        <div
                                            class="gt-progress-bar"
                                            style="
                          width: 55%;
                          animation: 2.6s ease 0s 1 normal none running
                            animate-positive;
                          opacity: 1;
                        ">
                                            <div class="gt-progress-value">
                                                <span class="counter-number2">55</span>%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="gt-skill-feature wow fadeInUp"
                                    data-wow-delay=".4s">
                                    <h3 class="gt-box-title">Laundry & Ironing</h3>
                                    <div class="gt-progress">
                                        <div
                                            class="gt-progress-bar"
                                            style="
                          width: 79%;
                          animation: 2.6s ease 0s 1 normal none running
                            animate-positive;
                          opacity: 1;
                        ">
                                            <div class="gt-progress-value">
                                                <span class="counter-number2">79</span>%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a
                                href="about.html"
                                class="gt-theme-btn wow fadeInUp"
                                data-wow-delay=".6s">VIEW All DETAILS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Hotel Feature Section Start -->
    <section class="gt-hotel-feature-section-2 section-padding fix pt-0">
        <div class="container">
            <div class="gt-hotel-feature-area">
                <div class="gt-hotel-feature-items wow fadeInUp" data-wow-delay=".2s">
                    <div class="icon">
                        <i class="flaticon-fitness-center"></i>
                    </div>
                    <div class="content">
                        <h3>Fitness Center</h3>
                        <p>Lorem ipsum dolor</p>
                    </div>
                </div>
                <div class="gt-hotel-feature-items wow fadeInUp" data-wow-delay=".4s">
                    <div class="icon">
                        <i class="flaticon-disinfect"></i>
                    </div>
                    <div class="content">
                        <h3>Disinfection</h3>
                        <p>Lorem ipsum dolor</p>
                    </div>
                </div>
                <div class="gt-hotel-feature-items wow fadeInUp" data-wow-delay=".6s">
                    <div class="icon">
                        <i class="flaticon-suite"></i>
                    </div>
                    <div class="content">
                        <h3>Rooms and Suites</h3>
                        <p>Lorem ipsum dolor</p>
                    </div>
                </div>
                <div class="gt-hotel-feature-items wow fadeInUp" data-wow-delay=".8s">
                    <div class="icon">
                        <i class="flaticon-luggage"></i>
                    </div>
                    <div class="content">
                        <h3>Store Luggage</h3>
                        <p>Lorem ipsum dolor</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section fix section-padding section-bg">
        <div class="container">
            <div class="gt-faq-wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="gt-faq-content">
                            <div class="gt-section-title mb-0">
                                <h6 class="wow fadeInUp">
                                    <img src="/assets/guest/img/sub-left.svg" alt="img" />
                                    Ask Question
                                </h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                    Frequently Asked <br />
                                    Question
                                </h2>
                            </div>
                            <p class="gt-faq-text wow fadeInUp" data-wow-delay=".5s">
                                Have questions about your stay, booking process, or our
                                services? You're in the right place. We’ve compiled answers
                                to the most common inquiries from our guests to help you plan
                                your trip with confidence. From check-in times to special
                                amenities, this section is designed to give you quick and
                                helpful information at a glance.
                            </p>
                            <div class="gt-faq-button wow fadeInUp" data-wow-delay=".7s">
                                <a href="contact.html" class="gt-theme-btn">
                                    <span class="gt-text-btn">
                                        <span class="gt-text-2">CONTACT US</span>
                                    </span>
                                </a>
                                <a href="about.html" class="gt-theme-btn gt-border-style">
                                    <span class="gt-text-btn">
                                        <span class="gt-text-2">ABOUT US</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp">
                        <div class="faq-items mt-0 ms-0">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item wow fadeInUp" data-wow-delay=".3s">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button
                                            class="accordion-button"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne"
                                            aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Is breakfast included in the room rate?
                                        </button>
                                    </h2>
                                    <div
                                        id="collapseOne"
                                        class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>
                                                Check-in is from 2:00 PM, and check-out is by 12:00
                                                PM. Early check-in and late check-out are subject to
                                                availability.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item wow fadeInUp" data-wow-delay=".5s">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button
                                            class="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo"
                                            aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            1. What time is check-in and check-out?
                                        </button>
                                    </h2>
                                    <div
                                        id="collapseTwo"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>
                                                Check-in is from 2:00 PM, and check-out is by 12:00
                                                PM. Early check-in and late check-out are subject to
                                                availability.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item wow fadeInUp" data-wow-delay=".7s">
                                    <h2 class="accordion-header" id="headingthree">
                                        <button
                                            class="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapsethree"
                                            aria-expanded="false"
                                            aria-controls="collapsethree">
                                            What are the cancellation and refund policies?
                                        </button>
                                    </h2>
                                    <div
                                        id="collapsethree"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="headingthree"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>
                                                Check-in is from 2:00 PM, and check-out is by 12:00
                                                PM. Early check-in and late check-out are subject to
                                                availability.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="accordion-item mb-0 wow fadeInUp"
                                    data-wow-delay=".3s">
                                    <h2 class="accordion-header" id="headingfour">
                                        <button
                                            class="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapsefour"
                                            aria-expanded="false"
                                            aria-controls="collapsefour">
                                            Are there family-friendly activities?
                                        </button>
                                    </h2>
                                    <div
                                        id="collapsefour"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="headingfour"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>
                                                Check-in is from 2:00 PM, and check-out is by 12:00
                                                PM. Early check-in and late check-out are subject to
                                                availability.
                                            </p>
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

    <!-- GT Discpunt Section Start -->
    <section
        class="gt-discount-section-2 fix section-padding bg-cover"
        style="background-image: url('/assets/guest/img/home-2/discount-bg.jpg')">
        <div class="container">
            <div class="gt-discount-wrapper">
                <div class="row g-4 justify-content-between">
                    <div class="col-lg-6">
                        <div class="discount-left">
                            <div class="gt-section-title mb-0">
                                <h6 class="wow fadeInUp">
                                    <img src="/assets/guest/img/sub-left.svg" alt="img" />
                                    Up to 30% Off
                                </h6>
                                <h2 class="text-white wow fadeInUp" data-wow-delay=".2s">
                                    Romantic Seaside Escape
                                </h2>
                            </div>
                            <p class="text wow fadeInUp" data-wow-delay=".4s">
                                Includes a private beach dinner, couples’ spa treatment, and a
                                sunset sail for two.
                            </p>
                            <a
                                href="room.html"
                                class="gt-theme-btn wow fadeInUp"
                                data-wow-delay=".6s">
                                <span class="gt-text-btn">
                                    <span class="gt-text-2">FIND OUR MORE</span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="discount-left style-2">
                            <div class="gt-section-title mb-0">
                                <h6 class="wow fadeInUp justify-content-end">
                                    <img src="/assets/guest/img/sub-right.svg" alt="img" />
                                    Enjoy 20% off
                                </h6>
                                <h2 class="text-white wow fadeInUp" data-wow-delay=".2s">
                                    Dine & Drink
                                </h2>
                            </div>
                            <p class="text wow fadeInUp" data-wow-delay=".4s">
                                Includes a private beach dinner, couples’ spa treatment
                            </p>
                            <a
                                href="restaurant.html"
                                class="gt-theme-btn wow fadeInUp"
                                data-wow-delay=".6s">
                                <span class="gt-text-btn">
                                    <span class="gt-text-2">FIND OUR MORE</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Testimonial Section Start -->
    <section
        class="gt-testimonial-section-2 fix section-padding bg-cover"
        style="
        background-image: url('/assets/guest/img/home-2/testimonial/testimonial-bg.jpg');
      ">
        <div class="container">
            <div class="gt-section-title text-center mb-0">
                <h6 class="wow fadeInUp justify-content-center">
                    <img src="/assets/guest/img/sub-left.svg" alt="img" />
                    Testimonial
                    <img src="/assets/guest/img/sub-right.svg" alt="img" />
                </h6>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">What Our Guests Say</h2>
            </div>
            <div class="testimonial-wrapper-2">
                <div class="map-bg">
                    <img src="/assets/guest/img/home-2/testimonial/map-shape.png" alt="img" />
                    <div class="testimonial-box-area">
                        <div class="testimonial-box-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p>
                                From the moment we arrived, every detail was flawless. The
                                staff anticipated our every need, and the suite was pure
                                perfection. We’ll be back soon!"
                            </p>
                            <div class="client-info">
                                <h4>Marvin McKinney</h4>
                                <span>Product Manager</span>
                            </div>
                            <div class="arrow-shape">
                                <img
                                    src="/assets/guest/img/home-2/testimonial/arrow-bottom.png"
                                    alt="img" />
                            </div>
                        </div>
                        <div class="client-info-image">
                            <img
                                src="/assets/guest/img/home-2/testimonial/client-1.png"
                                alt="img" />
                        </div>
                    </div>
                    <div class="testimonial-box-area style-2">
                        <div class="testimonial-box-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p>
                                From the moment we arrived, every detail was flawless. The
                                staff anticipated our every need, and the suite was pure
                                perfection. We’ll be back soon!"
                            </p>
                            <div class="client-info">
                                <h4>Marvin McKinney</h4>
                                <span>Product Manager</span>
                            </div>
                            <div class="arrow-shape">
                                <img
                                    src="/assets/guest/img/home-2/testimonial/arrow-bottom.png"
                                    alt="img" />
                            </div>
                        </div>
                        <div class="client-info-image">
                            <img
                                src="/assets/guest/img/home-2/testimonial/client-2.png"
                                alt="img" />
                        </div>
                    </div>
                    <div class="testimonial-box-area style-3">
                        <div class="testimonial-box-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p>
                                From the moment we arrived, every detail was flawless. The
                                staff anticipated our every need, and the suite was pure
                                perfection. We’ll be back soon!"
                            </p>
                            <div class="client-info">
                                <h4>Marvin McKinney</h4>
                                <span>Product Manager</span>
                            </div>
                            <div class="arrow-shape">
                                <img
                                    src="/assets/guest/img/home-2/testimonial/arrow-bottom.png"
                                    alt="img" />
                            </div>
                        </div>
                        <div class="client-info-image">
                            <img
                                src="/assets/guest/img/home-2/testimonial/client-3.png"
                                alt="img" />
                        </div>
                    </div>
                    <div class="testimonial-box-area style-4">
                        <div class="testimonial-box-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p>
                                From the moment we arrived, every detail was flawless. The
                                staff anticipated our every need, and the suite was pure
                                perfection. We’ll be back soon!"
                            </p>
                            <div class="client-info">
                                <h4>Marvin McKinney</h4>
                                <span>Product Manager</span>
                            </div>
                            <div class="arrow-shape">
                                <img
                                    src="/assets/guest/img/home-2/testimonial/arrow-bottom.png"
                                    alt="img" />
                            </div>
                        </div>
                        <div class="client-info-image">
                            <img
                                src="/assets/guest/img/home-2/testimonial/client-4.png"
                                alt="img" />
                        </div>
                    </div>
                    <div class="testimonial-box-area style-5">
                        <div class="testimonial-box-2">
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p>
                                From the moment we arrived, every detail was flawless. The
                                staff anticipated our every need, and the suite was pure
                                perfection. We’ll be back soon!"
                            </p>
                            <div class="client-info">
                                <h4>Marvin McKinney</h4>
                                <span>Product Manager</span>
                            </div>
                            <div class="arrow-shape">
                                <img
                                    src="/assets/guest/img/home-2/testimonial/arrow-bottom.png"
                                    alt="img" />
                            </div>
                        </div>
                        <div class="client-info-image">
                            <img
                                src="/assets/guest/img/home-2/testimonial/client-5.png"
                                alt="img" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT News Section Start -->
    <section class="news-section-2 section-padding fix">
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Lastest News
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Our Latest News Feed
                    </h2>
                </div>
                <a
                    href="news.html"
                    class="gt-theme-btn wow fadeInUp"
                    data-wow-delay=".4s">VIEW DETAILS</a>
            </div>
            <div class="row">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="gt-news-box-item-2">
                        <div class="gt-thumb">
                            <img src="/assets/guest/img/home-2/news/01.jpg" alt="img" />
                            <img src="/assets/guest/img/home-2/news/01.jpg" alt="img" />
                            <span class="gt-post-box"> OceanfrontStay </span>
                        </div>
                        <div class="gt-content">
                            <ul class="gt-list">
                                <li>
                                    <img
                                        src="/assets/guest/img/home-1/news/arrow-icon.png"
                                        alt="img" />
                                    April 12, 2025
                                </li>
                                <li>Hotel</li>
                            </ul>
                            <h3>
                                <a href="news-details.html">Your Ultimate Guide to Relaxing at the Beach Hotel Arlux</a>
                            </h3>
                            <a href="news-details.html" class="gt-theme-btn">VIEW MORE</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="gt-news-box-item-2">
                        <div class="gt-thumb">
                            <img src="/assets/guest/img/home-2/news/02.jpg" alt="img" />
                            <img src="/assets/guest/img/home-2/news/02.jpg" alt="img" />
                            <span class="gt-post-box"> BeachGetaway </span>
                        </div>
                        <div class="gt-content">
                            <ul class="gt-list">
                                <li>
                                    <img
                                        src="/assets/guest/img/home-1/news/arrow-icon.png"
                                        alt="img" />
                                    April 12, 2025
                                </li>
                                <li>Hotel</li>
                            </ul>
                            <h3>
                                <a href="news-details.html">Life at Aro Where Ocean Breeze Meets Arlux Modern Luxury</a>
                            </h3>
                            <a href="news-details.html" class="gt-theme-btn">VIEW MORE</a>
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
                Fallow Us On Instagram
            </div>
        </div>
    </section>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>
</body>

</html>