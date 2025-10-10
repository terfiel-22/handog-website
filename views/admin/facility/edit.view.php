<?php
$pageName = "Edit Facility"
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
                    <form class="row gy-3" method="POST" action="/admin/facilities/update" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $facility["id"] ?>">
                        <div class="col-12">
                            <label class="form-label" for="upload-file-multiple">Upload facility images</label>
                            <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>
                                <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1">
                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input id="upload-file-multiple" name="images[]" type="file" accept="image/*" hidden multiple>
                                </label>
                            </div>
                            <input type="hidden" name="existing_images" id="existing_images">
                            <?php if (isset($errors["image"])) : ?>
                                <div class="error-text">
                                    <?= $errors["image"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter facility name" value="<?= $facility["name"] ?>">
                            <?php if (isset($errors["name"])) : ?>
                                <div class="error-text">
                                    <?= $errors["name"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <?php foreach (\Http\Enums\FacilityType::toArray() as $type): ?>
                                    <option value="<?= $type ?>" <?= $facility["type"] == $type ? "selected" : "" ?>> <?= ucfirst($type) ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors["type"])) : ?>
                                <div class="error-text">
                                    <?= $errors["type"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="available_unit">Available Unit</label>
                            <input type="number" name="available_unit" id="available_unit" class="form-control" placeholder="Enter facility available unit" value="<?= $facility["available_unit"] ?>">
                            <?php if (isset($errors["available_unit"])) : ?>
                                <div class="error-text">
                                    <?= $errors["available_unit"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="capacity">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" placeholder="Enter facility capacity" value="<?= $facility["capacity"] ?>">
                            <?php if (isset($errors["capacity"])) : ?>
                                <div class="error-text">
                                    <?= $errors["capacity"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea type="number" name="description" id="description" class="form-control" placeholder="Enter facility description"><?= $facility["description"] ?></textarea>
                            <?php if (isset($errors["description"])) : ?>
                                <div class="error-text">
                                    <?= $errors["description"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_hourly">Hourly Rate</label>
                            <input type="number" name="rate_hourly" id="rate_hourly" class="form-control" placeholder="Enter facility hourly rate" value="<?= $facility["rate_hourly"] ?>">
                            <?php if (isset($errors["rate_hourly"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_hourly"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_8hrs">8-Hours Rate</label>
                            <input type="number" name="rate_8hrs" id="rate_8hrs" class="form-control" placeholder="Enter facility 8-hours rate" value="<?= $facility["rate_8hrs"] ?>">
                            <?php if (isset($errors["rate_8hrs"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_8hrs"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_12hrs">12-Hours Rate</label>
                            <input type="number" name="rate_12hrs" id="rate_12hrs" class="form-control" placeholder="Enter facility 12-hours rate" value="<?= $facility["rate_12hrs"] ?>">
                            <?php if (isset($errors["rate_12hrs"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_12hrs"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_1day">1-Day Rate</label>
                            <input type="number" name="rate_1day" id="rate_1day" class="form-control" placeholder="Enter facility 1-day rate" value="<?= $facility["rate_1day"] ?>">
                            <?php if (isset($errors["rate_1day"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_1day"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="amenities">Amenities <span class="fw-normal">(Optional)</span></label>
                            <textarea type="number" name="amenities" id="amenities" class="form-control" placeholder="Enter facility amenities"><?= $facility["amenities"] ?></textarea>
                        </div>
                        <div class="col-12 g-5">
                            <a href="/admin/facilities" class="btn btn-danger-600">Cancel</a>
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>
    <script>
        $(function() {
            const imagesPath = <?= json_encode($readableImagePaths) ?>;
            const $fileInputMultiple = $("#upload-file-multiple");
            const $uploadedImgsContainer = $(".uploaded-imgs-container");
            const $existingImagesInput = $("#existing_images");
            let existingImages = Array.isArray(imagesPath) ? imagesPath.filter(p => p.trim() !== '') : [];

            function updateHiddenInput() {
                $existingImagesInput.val(JSON.stringify(existingImages));
            }

            function createImagePreview(src, isExisting = false) {
                const $imgContainer = $("<div>").addClass(
                    "position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50"
                );

                const $removeButton = $("<button>", {
                    type: "button",
                    class: "uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex",
                    html: '<iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>'
                });

                const $imagePreview = $("<img>", {
                    class: "w-100 h-100 object-fit-cover",
                    src: src
                });

                $imgContainer.append($removeButton, $imagePreview);
                $uploadedImgsContainer.append($imgContainer);

                // Remove handler
                $removeButton.on("click", function() {
                    if (isExisting) {
                        // Remove from existing list
                        existingImages = existingImages.filter(img => img !== src);
                        updateHiddenInput();
                    } else {
                        URL.revokeObjectURL(src);
                    }
                    $imgContainer.remove();
                });
            }

            // ✅ Load existing images
            if (existingImages.length > 0) {
                existingImages.forEach(path => createImagePreview(path, true));
                updateHiddenInput();
            }

            // ✅ Handle new uploads
            $fileInputMultiple.on("change", function(e) {
                $uploadedImgsContainer.empty();
                existingImages = []; // Means user replaced all images
                updateHiddenInput();

                const files = e.target.files;
                $.each(files, function(_, file) {
                    const src = URL.createObjectURL(file);
                    createImagePreview(src);
                });
            });
        });
    </script>
</body>

</html>