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

    <!-- Facilities' Tabs -->
    <section
        class="gt-why-choose-us-section-2 section-padding fix">
        <div class="container">
            <div class="gt-section-title-area">
                <div class="gt-section-title">
                    <h6 class="wow fadeInUp">
                        <img src="/assets/guest/img/sub-left.svg" alt="img" />
                        Explore
                    </h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                        Facilities
                    </h2>
                </div>
            </div>

            <!-- Tabs -->
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tab-title active" data-bs-toggle="tab" data-bs-target="#cottage" type="button" role="tab">
                            Cottages
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tab-title" data-bs-toggle="tab" data-bs-target="#room" type="button" role="tab">
                            Rooms
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tab-title" data-bs-toggle="tab" data-bs-target="#event_hall" type="button" role="tab">
                            Event Hall
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link tab-title" data-bs-toggle="tab" data-bs-target="#exclusive" type="button" role="tab">
                            Exclusive
                        </button>
                    </li>
                </ul>

                <div class="tab-content pt-4">
                    <!-- Cottages -->
                    <div class="tab-pane fade show active" id="cottage" role="tabpanel">
                        <div class="row">
                            <?php foreach ($cottages as $cottage): ?>
                                <div
                                    class="col wow fadeInUp"
                                    data-wow-delay=".3s">
                                    <div class="gt-why-choose-us-images">
                                        <div class="gt-choose-us-image">
                                            <img
                                                src="<?= handleFilePath($cottage["image"], "/assets/guest/img/home-2/choose-us/choose-us-01.jpg") ?>"
                                                alt="<?= $cottage["name"] ?>"
                                                class="fixed-height-img clickable-img" />
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

                    <!-- Rooms -->
                    <div class="tab-pane fade" id="room" role="tabpanel">
                        <div class="gt-room-explore-wrapper">
                            <div class="swiper gt-room-explore-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($rooms as $room): ?>
                                        <div class="swiper-slide">
                                            <div
                                                class="gt-room-explore-items bg-cover h-40"
                                                style=" background-image: url('<?= handleFilePath($room['image'], "/assets/guest/img/home-2/room-explore/01.jpg") ?>');">
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

                    <!-- Event Hall -->
                    <div class="tab-pane fade" id="event_hall" role="tabpanel">
                        <div class="gt-room-explore-wrapper">
                            <div class="swiper gt-hall-explore-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($eventHalls as $eventHall): ?>
                                        <div class="swiper-slide">
                                            <div
                                                class="gt-room-explore-items bg-cover h-40"
                                                style=" background-image: url('<?= handleFilePath($eventHall['image'], "/assets/guest/img/home-2/room-explore/01.jpg") ?>');">
                                                <div class="row justify-content-end">
                                                    <div class="col-xl-5 col-lg-6">
                                                        <div class="gt-room-exlore-box-items">
                                                            <span class="gt-rate-title"> Rates From <?= moneyFormat($eventHall['rate_12hrs']) ?> </span>
                                                            <h3>
                                                                <a href="/facility?id=<?= $eventHall['id'] ?>"><?= $eventHall['name'] ?></a>
                                                            </h3>
                                                            <p>
                                                                <?= $eventHall['description'] ?>
                                                            </p>
                                                            <ul>
                                                                <li>
                                                                    <span>Capacity</span>
                                                                    : <?= $eventHall['capacity'] ?> Persons
                                                                </li>
                                                                <li>
                                                                    <span>Amenities</span>
                                                                    : <?= $eventHall['amenities'] ?>
                                                                </li>
                                                            </ul>
                                                            <a href="/facility?id=<?= $eventHall['id'] ?>" class="gt-theme-btn">ROOM DETAILS</a>
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

                    <div class="tab-pane fade" id="exclusive" role="tabpanel">
                        <div class="gt-service-wrapper-3">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="swiper service-image-slider">
                                        <div class="swiper-wrapper">
                                            <?php
                                            $exclusiveImages = explode(",", $exclusive["images"]);
                                            foreach ($exclusiveImages as $exclusiveImage):
                                            ?>
                                                <div class="swiper-slide">
                                                    <div class="service-image">
                                                        <img src="<?= handleFilePath($exclusiveImage, "/assets/guest/img/home-3/service/service-01.jpg") ?>" alt="<?= $exclusive["name"] ?>">
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
                                            <h2>
                                                <?= $exclusive["name"] ?>
                                            </h2>
                                        </div>
                                        <p class="service-text">
                                            <?= $exclusive["description"] ?>
                                        </p>
                                        <div class=" my-2">
                                            <h3>
                                                How much does it cost to rent the entire resort?
                                            </h3>
                                            <ul class="check-list">
                                                <li>
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <?= moneyFormat($exclusive["rate_12hrs"]) ?> for 12 hrs
                                                </li>
                                                <li>
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <?= moneyFormat($exclusive["rate_1day"]) ?> for 24 hrs
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="/facility?id=<?= $exclusive["id"] ?>" class="gt-theme-btn">BOOK NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tabs -->
        </div>
    </section>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>
</body>

</html>