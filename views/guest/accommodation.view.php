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
                            <?php foreach ($cottages as $cottage):
                                $cottageImages = explode(',', $cottage['images']);
                            ?>
                                <div
                                    class="col wow fadeInUp"
                                    data-wow-delay=".3s">
                                    <div class="gt-why-choose-us-images">
                                        <div class="gt-choose-us-image">
                                            <div class="img-container"
                                                data-images='<?= json_encode(array_map(fn($img) => handleFilePath($img, '/assets/guest/img/home-2/choose-us/choose-us-01.jpg'), $cottageImages)) ?>'>
                                                <img
                                                    src="<?= handleFilePath($cottageImages[0], "/assets/guest/img/home-2/choose-us/choose-us-01.jpg") ?>"
                                                    alt="<?= $cottage["name"] ?>"
                                                    class="fixed-height-img" />
                                            </div>
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
                                    <?php foreach ($rooms as $room):
                                        $roomImages = explode(',', $room['images']); ?>
                                        <div class="swiper-slide">
                                            <div
                                                data-images='<?= json_encode(array_map(fn($img) => handleFilePath($img, '/assets/guest/img/home-2/choose-us/choose-us-01.jpg'), $roomImages)) ?>'
                                                class="gt-room-explore-items bg-cover h-40 img-container"
                                                style=" background-image: url('<?= handleFilePath($roomImages[0], "/assets/guest/img/home-2/room-explore/01.jpg") ?>');">
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
                                    <?php foreach ($eventHalls as $eventHall):
                                        $eventHallImages = explode(',', $eventHall['images']); ?>
                                        <div class="swiper-slide">
                                            <div
                                                data-images='<?= json_encode(array_map(fn($img) => handleFilePath($img, '/assets/guest/img/home-2/choose-us/choose-us-01.jpg'), $eventHallImages)) ?>'
                                                class="gt-room-explore-items bg-cover h-40 img-container"
                                                style=" background-image: url('<?= handleFilePath($eventHallImages[0], "/assets/guest/img/home-2/room-explore/01.jpg") ?>');">
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
                                                            <a href="/facility?id=<?= $eventHall['id'] ?>" class="gt-theme-btn">VIEW DETAILS</a>
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

                    <!-- Exclusive -->
                    <div class="tab-pane fade" id="exclusive" role="tabpanel">
                        <div class="gt-room-explore-wrapper">
                            <div class="swiper gt-exclusive-explore-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($exclusives as $exclusive):
                                        $exclusiveImages = explode(',', $exclusive['images']); ?>
                                        <div class="swiper-slide">
                                            <div
                                                data-images='<?= json_encode(array_map(fn($img) => handleFilePath($img, '/assets/guest/img/home-2/choose-us/choose-us-01.jpg'), $exclusiveImages)) ?>'
                                                class="gt-room-explore-items bg-cover h-40 img-container"
                                                style=" background-image: url('<?= handleFilePath($exclusiveImages[0], "/assets/guest/img/home-2/room-explore/01.jpg") ?>');">
                                                <div class="row justify-content-end">
                                                    <div class="col-xl-5 col-lg-6">
                                                        <div class="gt-room-exlore-box-items">
                                                            <span class="gt-rate-title"> Rates From <?= moneyFormat($exclusive['rate_12hrs']) ?> </span>
                                                            <h3>
                                                                <a href="/facility?id=<?= $exclusive['id'] ?>"><?= $exclusive['name'] ?></a>
                                                            </h3>
                                                            <p>
                                                                <?= $exclusive['description'] ?>
                                                            </p>
                                                            <ul>
                                                                <li>
                                                                    <span>Capacity</span>
                                                                    : <?= $exclusive['capacity'] ?> Persons
                                                                </li>
                                                                <li>
                                                                    <span>Amenities</span>
                                                                    : <?= $exclusive['amenities'] ?>
                                                                </li>
                                                            </ul>
                                                            <a href="/facility?id=<?= $exclusive['id'] ?>" class="gt-theme-btn">VIEW DETAILS</a>
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
                </div>
            </div>
            <!-- End Tabs -->
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modalSlider" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center align-items-center">
            <div class="modal-content bg-transparent border-0 text-center position-relative" id="modalSliderContent">
                <!-- Close button -->
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 60vh;">
                    <img id="modalImage" src="" class="modal-img rounded shadow-lg" alt="Gallery image">

                    <!-- Navigation Buttons -->
                    <button id="prevBtn" class="btn btn-dark position-absolute top-50 start-0 translate-middle-y px-3 py-2 opacity-75">
                        <i class="fa fa-chevron-left fa-lg"></i>
                    </button>
                    <button id="nextBtn" class="btn btn-dark position-absolute top-50 end-0 translate-middle-y px-3 py-2 opacity-75">
                        <i class="fa fa-chevron-right fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>

    <!-- Display Image On Modal Slider -->
    <script>
        $(document).ready(function() {
            let currentImages = [];
            let currentIndex = 0;
            const modalElement = document.getElementById('modalSlider');
            const modal = new bootstrap.Modal(modalElement);

            const $modalImage = $('#modalImage');

            $('.img-container').on('click', function() {
                currentImages = JSON.parse($(this).attr('data-images'));
                currentIndex = 0;
                $modalImage.attr('src', currentImages[currentIndex]);
                modal.show();
            });

            $('#prevBtn').on('click', function() {
                if (!currentImages.length) return;
                currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
                $modalImage.attr('src', currentImages[currentIndex]);
            });

            $('#nextBtn').on('click', function() {
                if (!currentImages.length) return;
                currentIndex = (currentIndex + 1) % currentImages.length;
                $modalImage.attr('src', currentImages[currentIndex]);
            });

            $(modalElement).on('hidden.bs.modal', function() {
                $modalImage.attr('src', '');
                currentImages = [];
            });

            $(document).on('keydown', function(e) {
                if (!currentImages.length) return;

                if (e.key === "ArrowLeft") {
                    currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
                } else if (e.key === "ArrowRight") {
                    currentIndex = (currentIndex + 1) % currentImages.length;
                }
                $modalImage.attr('src', currentImages[currentIndex]);
            });
        });
    </script>

</body>

</html>