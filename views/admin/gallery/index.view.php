<?php
$pageName = "Gallery"
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

            <!-- Table -->
            <div class="card basic-data-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">List of Images</h6>
                    <a href="/admin/gallery/create" class="btn btn-primary-600 radius-8 px-20 py-11">Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($images as $image): ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600">#<?= $image['id'] ?></a></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= handleFilePath($image['image'], "/assets/admin/images/user-list/user-list1.png")  ?> " alt="<?= $image['name'] ?>" class="flex-shrink-0 me-12 radius-8" style="width: 80px;">
                                                <h6 class="text-md mb-0 fw-medium flex-grow-1"><?= $image['name'] ?></h6>
                                            </div>
                                        </td>
                                        <td><?= $image['description'] ?></td>
                                        <td>
                                            <!-- <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                            </a> -->

                                            <div class="d-flex align-items-center gap-2">
                                                <a href="/admin/gallery/edit?id=<?= $image["id"] ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                                </a>

                                                <button
                                                    type="button"
                                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    onclick="deleteModalForm('/admin/gallery/destroy','<?= $image['id'] ?>')"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#al-warning-alert">
                                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <?php view("admin/shared/delete-modal.php") ?>

    <script>
        let table = new DataTable('#dataTable');
    </script>


</body>

</html>