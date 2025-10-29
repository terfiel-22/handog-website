<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Home"
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

    <!-- Promo Section Start -->
    <?php if (!empty($promos)): ?>
        <div class="marquee-section fix">
            <div class="marquee">
                <?php foreach (range(0, 3) as $_): ?>
                    <div class="marquee-group">
                        <?php foreach ($promos as $i => $promo): ?>
                            <div class="text">
                                <img src="/assets/guest/img/home-1/star.png" alt="img">
                            </div>
                            <div class="text"><?= $promo["description"] ?></div>
                            <div class="text">
                                <img src="/assets/guest/img/home-1/star.png" alt="img">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- GT Hero Section Start -->
    <section
        class="scroll-down-intro-banner-container">
        <div class="scroll-down-intro-banner-container">
            <video class="scroll-down-hero-banner-img-desktop" autoplay="" muted="" loop="" playsinline="">
                <source src="https://media.istockphoto.com/id/1459175082/video/mid-adult-woman-in-a-hotel-pool.mp4?s=mp4-640x640-is&k=20&c=ZN1ytJAbTJ2kIczDspWXxC0gn6G2AOr1kXmvdIScZv8=" type="video/mp4">
            </video>
            <video class="scroll-down-hero-banner-img-mobile" autoplay="" muted="" loop="" playsinline="">
                <source src="https://media.istockphoto.com/id/1459175082/video/mid-adult-woman-in-a-hotel-pool.mp4?s=mp4-640x640-is&k=20&c=ZN1ytJAbTJ2kIczDspWXxC0gn6G2AOr1kXmvdIScZv8=" type="video/mp4">
            </video>
            <div class="scroll-down-hero-banner-content gt-hero-2">
                <div class="hero-shape-bottom">
                    <img src="/assets/guest/img/bottom-shape2.png" alt="img" />
                </div>
                <div class="social-icon d-flex align-items-center">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <span>Follow Us:</span>
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
                            <a href="/accommodation" class="gt-theme-btn">DISCOVER ROOM</a>
                            <a href="/booking" class="gt-theme-btn style-2">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Rates Section Start -->
    <section class="gt-why-choose-us-section-2 section-padding fix">
        <div class="gt-choose-us-shape">
            <img src="/assets/guest/img/home-2/choose-us/Vector-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Luxury stays, flexible pricing
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Rates
                    </h2>
                </div>
            </div>
            <div class="row g-3">
                <div
                    class="col-12 col-md-4 wow fadeInUp"
                    data-wow-delay=".3s">
                    <div class="colored-container wow fadeInUp" data-wow-delay=".2s">
                        <div class="title-text-container">
                            <h3>
                                Entrance Pool Rates
                            </h3>
                        </div>
                        <div class="mb-2">
                            <h4 class="mb-2">Day Rate (6AM - 5PM)</h4>
                            <ul class="check-list">
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    Adult - 120 (10 yrs old above)
                                </li>
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    Kid - 90 (3-9 yrs old)
                                </li>
                            </ul>
                        </div>
                        <div class="mb-2">
                            <h4 class="mb-2">Night Rate (6PM - 5AM)</h4>
                            <ul class="check-list">
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    Adult - 200 (10 yrs old above)
                                </li>
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    Kid - 100 (3-9 yrs old)
                                </li>
                            </ul>
                        </div>
                        <div class="my-3">
                            <ul class="check-list">
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    1 & 2 yrs old are free
                                </li>
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    Senior and PWD - 20% discount
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="col-12 col-md-8 wow fadeInUp"
                    data-wow-delay=".3s">
                    <div class="colored-container wow fadeInUp" data-wow-delay=".2s">
                        <div class="title-text-container">
                            <h3>
                                What we offer:
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h4 class="mb-2">Event Hall</h4>
                                <ul class="check-list">
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        3,000 per hour
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        25,000 for 12hrs with 1 standard room + chairs & tables for 50pax
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <h4 class="mb-2">Exclusive Rates</h4>
                                <ul class="check-list">
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        55,000 for 12hrs
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        80,000 for 24hrs
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row my-2 justify-content-center">
                            <div class="col-12 col-md-8 col-lg-6">
                                <h4 class="mb-2">Rooms</h4>
                                <ul class="check-list">
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Standard Room - 1,500 for 12hrs
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Family Room - 2,500 for 12hrs
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-2">Additional Offers</h4>
                                <ul class="check-list">
                                    <li>
                                        <i class="fa-solid fa-circle-check"></i>
                                        Videoke for Rent - 1,500 for 8hrs
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Safety Guidelines Section Start -->
    <section class="gt-why-choose-us-section-2 section-padding fix section-bg-3">
        <div class="gt-choose-us-shape">
            <img src="/assets/guest/img/home-2/choose-us/Vector-01.png" alt="img" />
        </div>
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        For a safe and enjoyable stay
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Rules & Safety Guidelines
                    </h2>
                </div>
            </div>
            <div class="gt-hotel-feature-area row g-3 pt-3">
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".2s">
                    <div class="icon">
                        <i class="flaticon-fitness-center"></i>
                    </div>
                    <div class="content">
                        <h3>No Lifeguard On Duty</h3>
                        <p>Swim at your own risk</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".4s">
                    <div class="icon">
                        <i class="flaticon-disinfect"></i>
                    </div>
                    <div class="content">
                        <h3>Watch Your Children</h3>
                        <p>At all times</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".4s">
                    <div class="icon">
                        <i class="flaticon-disinfect"></i>
                    </div>
                    <div class="content">
                        <h3>Shower</h3>
                        <p>Before entering the pool</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".6s">
                    <div class="icon">
                        <i class="flaticon-suite"></i>
                    </div>
                    <div class="content">
                        <h3>No Pets Allowed</h3>
                        <p>By the pool side</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".8s">
                    <div class="icon">
                        <i class="flaticon-luggage"></i>
                    </div>
                    <div class="content">
                        <h3>Foods and Drinks</h3>
                        <p>Are not allowed by the poolside</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".2s">
                    <div class="icon">
                        <i class="flaticon-fitness-center"></i>
                    </div>
                    <div class="content">
                        <h3>No Diving</h3>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".4s">
                    <div class="icon">
                        <i class="flaticon-disinfect"></i>
                    </div>
                    <div class="content">
                        <h3>No Running</h3>
                        <p>Around the poolside</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".6s">
                    <div class="icon">
                        <i class="flaticon-suite"></i>
                    </div>
                    <div class="content">
                        <h3>No Peeing</h3>
                        <p>In the pool</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".8s">
                    <div class="icon">
                        <i class="flaticon-luggage"></i>
                    </div>
                    <div class="content">
                        <h3>No Pushing</h3>
                        <p>Or horseplay</p>
                    </div>
                </div>
                <div class="col-md-4 col-12 gt-hotel-feature-items wow fadeInUp" data-wow-delay=".8s">
                    <div class="icon">
                        <i class="flaticon-luggage"></i>
                    </div>
                    <div class="content">
                        <h3>Drugs and Firearms</h3>
                        <p>Are strictly prohibited</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Events Section Start -->
    <section class="news-section-2 section-padding fix">
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Be part of unforgettable moments
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Upcoming Events
                    </h2>
                </div>
            </div>
            <?php if (!empty($events)): ?>
                <div class="swiper event-image-slider gt-service-wrapper-3">
                    <div class="swiper-wrapper">
                        <?php foreach ($events as $index => $event): ?>
                            <div class="swiper-slide">
                                <div class="gt-news-box-item-2">
                                    <div class="gt-thumb fixed-height-img">
                                        <img src="<?= handleImage($event["image"], "/assets/guest/img/home-2/news/01.jpg") ?>" alt="<?= $event["name"] ?>" />
                                        <img src="<?= handleImage($event["image"], "/assets/guest/img/home-2/news/01.jpg") ?>" alt="<?= $event["name"] ?>" />
                                    </div>
                                    <div class="gt-content">
                                        <ul class="gt-list">
                                            <li>
                                                <img src="/assets/guest/img/home-1/news/arrow-icon.png" alt="img" />
                                                <?= formatDatetimeToReadable($event["date"]) ?>
                                            </li>
                                        </ul>
                                        <h3><?= htmlspecialchars($event["name"]) ?></h3>
                                        <button
                                            class="gt-theme-btn view-details-btn"
                                            data-index="<?= $index ?>">
                                            VIEW DETAILS
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="array-button-2 justify-content-center mt-3">
                        <button class="array-prev"><i class="fa-solid fa-chevron-left"></i></button>
                        <button class="array-next"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12">
                    <p>No upcoming events.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Frequently Ask Question Section -->
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
                                <a href="/about" class="gt-theme-btn">
                                    <span class="gt-text-btn">
                                        <span class="gt-text-2">CONTACT US</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp">
                        <div class="faq-items mt-0 ms-0">
                            <div class="accordion" id="accordionExample">
                                <?php if (!empty($faqs)): ?>
                                    <?php foreach ($faqs as $index => $faq): ?>
                                        <div class="accordion-item wow fadeInUp" data-wow-delay=".<?= $index + $index + 1 ?>s">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button
                                                    class="accordion-button <?= $index == 0 ? "" : "collapsed" ?>"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse<?= $index ?>"
                                                    aria-expanded="<?= $index == 0 ? "true" : "false" ?>"
                                                    aria-controls="collapse<?= $index ?>">
                                                    <?= $faq["question"] ?>
                                                </button>
                                            </h2>
                                            <div
                                                id="collapse<?= $index ?>"
                                                class="accordion-collapse collapse <?= $index == 0 ? "show" : "" ?>"
                                                aria-labelledby="heading<?= $index ?>"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>
                                                        <?= $faq["answer"] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No frequently asked question.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="eventCarousel" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner" id="carouselContent"></div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" id="prevEventBtn">Previous Event</button>
                        <button type="button" class="btn btn-primary" id="nextEventBtn">Next Event </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>

    <!-- Event Modal Script -->
    <script>
        $(function() {
            // events from PHP
            const events = <?= json_encode($events) ?> || [];

            let initialIndex = 0;
            let carouselInstance = null;

            function formatDateStr(dateStr) {
                const date = new Date(dateStr);

                const options = {
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: true,
                    month: "short",
                    day: "2-digit",
                    year: "numeric",
                };

                return new Intl.DateTimeFormat("en-US", options).format(date);
            }

            function buildCarousel(selectedIndex) {
                const $carousel = $("#carouselContent");
                $carousel.empty();

                if (!events.length) {
                    $carousel.append(
                        `<div class="carousel-item active">
                            <div class="p-4">No events available.</div>
                        </div>`
                    );
                    return;
                }

                events.forEach((event, i) => {
                    const imgSrc = event.image ?? "/assets/guest/img/home-2/news/01.jpg";
                    const name = $('<div>').text(event.name ?? '').html();
                    const dateStr = $('<div>').text(event.date ?? '').html();
                    const date = formatDateStr(dateStr);

                    const desc = $('<div>').text(event.description ?? 'No description available.').html();

                    const activeClass = i === selectedIndex ? "active" : "";
                    const item = `
                        <div class="carousel-item ${activeClass}">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <img src="${imgSrc}" class="d-block w-100 rounded fixed-height-img" alt="${name}">
                                </div>
                                <div class="col-md-7"> 
                                    <div class="gt-news-details-content">
                                        <h2>${name}</h2>
                                        <hr/>
                                        <p><strong>Date:</strong> ${date}</p> 
                                        <p>${desc}</p>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    `;
                    $carousel.append(item);
                });
            }

            $(".view-details-btn").on("click", function() {
                initialIndex = parseInt($(this).data("index")) || 0;
                buildCarousel(initialIndex);

                const modalEl = document.getElementById('eventModal');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            });

            $('#eventModal').on('shown.bs.modal', function() {
                carouselInstance = bootstrap.Carousel.getOrCreateInstance('#eventCarousel', {
                    ride: false,
                    interval: false
                });

                if (typeof initialIndex === 'number' && !Number.isNaN(initialIndex)) {
                    try {
                        carouselInstance.to(initialIndex);
                    } catch (e) {
                        // fallback: do nothing
                    }
                }
            });

            $("#prevEventBtn").on("click", function() {
                if (carouselInstance) carouselInstance.prev();
            });
            $("#nextEventBtn").on("click", function() {
                if (carouselInstance) carouselInstance.next();
            });

            $('#eventModal').on('hidden.bs.modal', function() {
                $("#carouselContent").empty();
                carouselInstance = null;
            });

            $(document).on('keydown', function(e) {
                const modalVisible = $('#eventModal').hasClass('show');
                if (!modalVisible) return;

                if (e.key === "ArrowLeft") {
                    if (carouselInstance) carouselInstance.prev();
                } else if (e.key === "ArrowRight") {
                    if (carouselInstance) carouselInstance.next();
                }
            });
        });
    </script>
</body>

</html>