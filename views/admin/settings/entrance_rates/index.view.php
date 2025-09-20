<?php
$pageName = "Entrance Rates"
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
                    <h6 class="card-title mb-0">Entrance Rates</h6>
                    <a href="/admin/settings/entrance-rates/create" class="btn btn-primary-600 radius-8 px-20 py-11">Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Guest Type</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rates as $rate): ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600">#<?= $rate['id'] ?></a></td>
                                        <td><?= $rate['guest_type'] ?></td>
                                        <td><?= $rate['start_time'] ?></td>
                                        <td><?= $rate['end_time'] ?></td>
                                        <td><?= moneyFormat($rate['rate']) ?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                            </a>
                                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                            </a>
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
    <script>
        let table = new DataTable('#dataTable');
    </script>

</body>

</html>