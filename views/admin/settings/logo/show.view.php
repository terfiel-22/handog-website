<?php
$pageName = "Logo"
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

            <!-- Data -->
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="card-title mb-0">Modify <?= $pageName ?></h6>
                    <p class="text-secondary small">Fields marked with an asterisk (*) are required.</p>
                </div>

                <div class="card-body">
                    <form class="row gy-3" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $logo['id'] ?>">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="upload-logo">Upload logo *</label>
                            <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                <div class="uploaded-imgs-container d-flex gap-3 flex-wrap" id="uploaded-logo-container"></div>
                                <label class="upload-logo h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1">
                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input id="upload-logo" name="logo[]" type="file" accept="image/*" hidden>
                                </label>
                            </div>
                            <input type="hidden" name="existing_logo" id="existing_logo">
                            <?php if (isset($errors["logo"])) : ?>
                                <div class="error-text">
                                    <?= $errors["logo"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="upload-icon">Upload icon *</label>
                            <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                <div class="uploaded-imgs-container d-flex gap-3 flex-wrap" id="uploaded-icon-container"></div>
                                <label class="upload-icon h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1">
                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input id="upload-icon" name="icon[]" type="file" accept="image/*" hidden>
                                </label>
                            </div>
                            <input type="hidden" name="existing_icon" id="existing_icon">
                            <?php if (isset($errors["icon"])) : ?>
                                <div class="error-text">
                                    <?= $errors["icon"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 g-5">
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <!-- Upload Logo -->
    <script>
        $(function() {
            const imagesPath = <?= json_encode($readableLogo) ?>;
            const $fileInputMultiple = $("#upload-logo");
            const $uploadedImgsContainer = $("#uploaded-logo-container");
            const $existingImagesInput = $("#existing_logo");
            let existingImages = Array.isArray(imagesPath) ? imagesPath.filter(p => p.trim() !== '') : [];

            function updateHiddenInput() {
                $existingImagesInput.val(JSON.stringify(existingImages));
            }

            function createImagePreview(src, isExisting = false) {
                const $imgContainer = $("<div>").addClass(
                    "position-relative h-120-px w-300-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50"
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

    <!-- Upload Icon -->
    <script>
        $(function() {
            const imagesPath = <?= json_encode($readableIcon) ?>;
            const $fileInputMultiple = $("#upload-icon");
            const $uploadedImgsContainer = $("#uploaded-icon-container");
            const $existingImagesInput = $("#existing_icon");
            let existingImages = Array.isArray(imagesPath) ? imagesPath.filter(p => p.trim() !== '') : [];

            function updateHiddenInput() {
                $existingImagesInput.val(JSON.stringify(existingImages));
            }

            function createImagePreview(src, isExisting = false) {
                const $imgContainer = $("<div>").addClass(
                    "position-relative h-120-px w-300-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50"
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