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
                <?php foreach ($folders as $folder):
                    $images = explode(',', $folder['images']);
                ?>
                    <div class="col-12 col-md-4">
                        <div class="gallery-folder"
                            data-images='<?= json_encode(array_map(fn($img) => handleFilePath($img, '/assets/guest/img/home-2/choose-us/choose-us-01.jpg'), $images)) ?>'>
                            <img
                                src="<?= handleFilePath($images[0], '/assets/guest/img/home-2/choose-us/choose-us-01.jpg') ?>"
                                class="img-fluid gallery-img"
                                alt="<?= $folder['name'] ?>">
                            <h5 class="mt-2"><?= $folder['name'] ?></h5>
                            <p class="text-muted small"><?= $folder['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
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

            const modalImage = $('#modalImage');

            $('.gallery-folder').on('click', function() {
                currentImages = JSON.parse($(this).attr('data-images'));
                currentIndex = 0;
                modalImage.attr('src', currentImages[currentIndex]);
                modal.show();
            });

            $('#prevBtn').on('click', function() {
                if (!currentImages.length) return;
                currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
                modalImage.attr('src', currentImages[currentIndex]);
            });

            $('#nextBtn').on('click', function() {
                if (!currentImages.length) return;
                currentIndex = (currentIndex + 1) % currentImages.length;
                modalImage.attr('src', currentImages[currentIndex]);
            });

            $(modalElement).on('hidden.bs.modal', function() {
                modalImage.attr('src', '');
                currentImages = [];
            });

            $(document).on('keydown', function(e) {
                if (!currentImages.length) return;

                if (e.key === "ArrowLeft") {
                    currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
                } else if (e.key === "ArrowRight") {
                    currentIndex = (currentIndex + 1) % currentImages.length;
                }
                modalImage.attr('src', currentImages[currentIndex]);
            });
        });
    </script>
</body>

</html>