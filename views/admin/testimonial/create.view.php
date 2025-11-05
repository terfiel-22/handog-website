<?php
$pageName = "Add Testimonial"
?>

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<!-- Head Tag -->
<?php view("admin/partials/head.partial.php", [
    'title' => "Handog Admin | " . $pageName
]) ?>

<body>

    <!-- Sidebar -->
    <?php view("admin/partials/sidebar.partial.php") ?>

    <!-- Main Section -->
    <main class="dashboard-main">

        <!-- Sidebar -->
        <?php view("admin/partials/navbar.partial.php") ?>


        <div class="dashboard-main-body">

            <!-- Breadcrumbs -->
            <?php view("admin/partials/breadcrumb.partial.php", compact('pageName')) ?>

            <!-- Form -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0"><?= $pageName ?></h6>
                </div>

                <div class="card-body">
                    <form class="row gy-3" method="POST" action="/admin/testimonials/store" enctype="multipart/form-data">
                        <div class="col-12">
                            <label class="form-label" for="upload-file-multiple">Upload client image</label>
                            <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>
                                <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1">
                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input id="upload-file-multiple" name="images[]" type="file" accept="image/*" hidden>
                                </label>
                            </div>
                            <?php if (isset($errors["image"])) : ?>
                                <div class="error-text">
                                    <?= $errors["image"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="name">Client Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="<?= old('name') ?>">
                            <?php if (isset($errors["name"])) : ?>
                                <div class="error-text">
                                    <?= $errors["name"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="work">Client Work</label>
                            <input type="text" name="work" id="work" class="form-control" placeholder="Enter work" value="<?= old('work') ?>">
                            <?php if (isset($errors["work"])) : ?>
                                <div class="error-text">
                                    <?= $errors["work"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="rating">Rating</label>
                            <div id="star-rating" class="mb-2 d-flex gap-3">
                                <iconify-icon icon="ic:baseline-star" class="star" data-value="1"></iconify-icon>
                                <iconify-icon icon="ic:baseline-star" class="star" data-value="2"></iconify-icon>
                                <iconify-icon icon="ic:baseline-star" class="star" data-value="3"></iconify-icon>
                                <iconify-icon icon="ic:baseline-star" class="star" data-value="4"></iconify-icon>
                                <iconify-icon icon="ic:baseline-star" class="star" data-value="5"></iconify-icon>
                            </div>

                            <input type="hidden" name="rating" id="rating" value="<?= old('rating') ?>">

                            <?php if (isset($errors["rating"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rating"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="feedback">Feedback</label>
                            <textarea type="number" name="feedback" id="feedback" class="form-control" placeholder="Enter event feedback"><?= old('feedback') ?></textarea>
                            <?php if (isset($errors["feedback"])) : ?>
                                <div class="error-text">
                                    <?= $errors["feedback"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 g-5">
                            <a href="/admin/testimonials" class="btn btn-danger-600">Cancel</a>
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <!-- Image Upload -->
    <script>
        const fileInputMultiple = document.getElementById("upload-file-multiple");
        const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

        fileInputMultiple.addEventListener("change", (e) => {
            uploadedImgsContainer.innerHTML = '';
            const files = e.target.files;

            Array.from(files).forEach(file => {
                const src = URL.createObjectURL(file);

                const imgContainer = document.createElement('div');
                imgContainer.classList.add('position-relative', 'h-120-px', 'w-120-px', 'border', 'input-form-light', 'radius-8', 'overflow-hidden', 'border-dashed', 'bg-neutral-50');

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('uploaded-img__remove', 'position-absolute', 'top-0', 'end-0', 'z-1', 'text-2xxl', 'line-height-1', 'me-8', 'mt-8', 'd-flex');
                removeButton.innerHTML = '<iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>';

                const imagePreview = document.createElement('img');
                imagePreview.classList.add('w-100', 'h-100', 'object-fit-cover');
                imagePreview.src = src;

                imgContainer.appendChild(removeButton);
                imgContainer.appendChild(imagePreview);
                uploadedImgsContainer.appendChild(imgContainer);

                removeButton.addEventListener('click', () => {
                    URL.revokeObjectURL(src);
                    imgContainer.remove();
                });
            });
        });
    </script>

    <!-- Star Rating -->
    <script>
        $(document).ready(function() {
            $('#star-rating .star').on('click', function() {
                const rating = $(this).data('value');

                $('#star-rating .star').removeClass('active');

                $('#star-rating .star').each(function(index) {
                    if (index < rating) {
                        $(this).addClass('active');
                    }
                });

                $('#rating').val(rating);
            });

            const currentRating = parseInt($('#rating').val());
            if (currentRating) {
                $('#star-rating .star').each(function(index) {
                    if (index < currentRating) {
                        $(this).addClass('active');
                    }
                });
            }
        });
    </script>
</body>

</html>