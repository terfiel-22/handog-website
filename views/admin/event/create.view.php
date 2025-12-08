<?php
$pageName = "Add Event"
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
                <div class="card-header pb-0">
                    <h6 class="card-title mb-0"><?= $pageName ?></h6>
                    <p class="text-secondary small">Fields marked with an asterisk (*) are required.</p>
                </div>

                <div class="card-body">
                    <form class="row gy-3" method="POST" action="/admin/events/store" enctype="multipart/form-data">
                        <div class="col-12">
                            <label class="form-label" for="upload-file-multiple">Upload event image *</label>
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
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name">Name *</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter event name" value="<?= old('name') ?>">
                            <?php if (isset($errors["name"])) : ?>
                                <div class="error-text">
                                    <?= $errors["name"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="date">Event Date *</label>
                            <input type="text" name="date" id="date" class="form-control" placeholder="Enter event date" value="<?= old('date') ?>">
                            <?php if (isset($errors["date"])) : ?>
                                <div class="error-text">
                                    <?= $errors["date"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description">Description *</label>
                            <textarea type="number" name="description" id="description" class="form-control" placeholder="Enter event description"><?= old('description') ?></textarea>
                            <?php if (isset($errors["description"])) : ?>
                                <div class="error-text">
                                    <?= $errors["description"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 g-5">
                            <a href="/admin/events" class="btn btn-danger-600">Cancel</a>
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

    <script>
        // Flat pickr or date picker js
        function getDatePicker(receiveID) {
            flatpickr(receiveID, {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
            });
        }

        getDatePicker("#date");
    </script>
</body>

</html>