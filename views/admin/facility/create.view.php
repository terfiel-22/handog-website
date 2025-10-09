<?php
$pageName = "Add Facility"
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
                    <form class="row gy-3" method="POST" action="/admin/facilities/store" enctype="multipart/form-data">
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
                            <?php if (isset($errors["image"])) : ?>
                                <div class="error-text">
                                    <?= $errors["image"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter facility name" value="<?= old('name') ?>">
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
                                    <option value="<?= $type ?>"> <?= ucfirst($type) ?> </option>
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
                            <input type="number" name="available_unit" id="available_unit" class="form-control" placeholder="Enter facility available unit" value="<?= old('available_unit') ?>">
                            <?php if (isset($errors["available_unit"])) : ?>
                                <div class="error-text">
                                    <?= $errors["available_unit"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="capacity">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" placeholder="Enter facility capacity" value="<?= old('capacity') ?>">
                            <?php if (isset($errors["capacity"])) : ?>
                                <div class="error-text">
                                    <?= $errors["capacity"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description">Description</label>
                            <textarea type="number" name="description" id="description" class="form-control" placeholder="Enter facility description"><?= old('description') ?></textarea>
                            <?php if (isset($errors["description"])) : ?>
                                <div class="error-text">
                                    <?= $errors["description"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_hourly">Hourly Rate</label>
                            <input type="number" name="rate_hourly" id="rate_hourly" class="form-control" placeholder="Enter facility hourly rate" value="<?= old('rate_hourly') ?>">
                            <?php if (isset($errors["rate_hourly"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_hourly"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_8hrs">8-Hours Rate</label>
                            <input type="number" name="rate_8hrs" id="rate_8hrs" class="form-control" placeholder="Enter facility 8-hours rate" value="<?= old('rate_8hrs') ?>">
                            <?php if (isset($errors["rate_8hrs"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_8hrs"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_12hrs">12-Hours Rate</label>
                            <input type="number" name="rate_12hrs" id="rate_12hrs" class="form-control" placeholder="Enter facility 12-hours rate" value="<?= old('rate_12hrs') ?>">
                            <?php if (isset($errors["rate_12hrs"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_12hrs"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="rate_1day">1-Day Rate</label>
                            <input type="number" name="rate_1day" id="rate_1day" class="form-control" placeholder="Enter facility 1-day rate" value="<?= old('rate_1day') ?>">
                            <?php if (isset($errors["rate_1day"])) : ?>
                                <div class="error-text">
                                    <?= $errors["rate_1day"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="amenities">Amenities <span class="fw-normal">(Optional)</span></label>
                            <textarea type="number" name="amenities" id="amenities" class="form-control" placeholder="Enter facility amenities"><?= old('amenities') ?></textarea>
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
</body>

</html>