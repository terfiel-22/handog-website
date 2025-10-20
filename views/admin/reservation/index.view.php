<?php
$pageName = "Reservations"
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
                    <h6 class="card-title mb-0">List of Reservations</h6>
                    <a href="/admin/reservations/create" class="btn btn-primary-600 radius-8 px-20 py-11">Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Contact Person</th>
                                    <th scope="col">Guest Count</th>
                                    <th scope="col">Facility</th>
                                    <th scope="col">With Videoke</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservations as $reservation): ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600">#<?= $reservation['id'] ?></a></td>
                                        <td>
                                            <h6 class="text-md mb-0 fw-normal"><?= $reservation['contact_person'] ?></h6>
                                            <span class="text-sm text-secondary-light fw-normal"><?= $reservation['contact_email'] ?></span><br />
                                            <span class="text-sm text-secondary-light fw-normal"><?= $reservation['contact_no'] ?></span><br />
                                            <span class="text-sm text-secondary-light fw-normal"><?= $reservation['contact_address'] ?></span>
                                        </td>
                                        <td><?= $reservation['guest_count'] ?></td>
                                        <td><?= $reservation['facility'] ?></td>
                                        <td><?= ucfirst($reservation['rent_videoke']) ?></td>
                                        <td><?= moneyFormat($reservation['total_price']) ?></td>
                                        <td><?= moneyFormat($reservation['paid_amount']) ?></td>
                                        <td><?= moneyFormat($reservation['total_price'] - $reservation['paid_amount']) ?></td>
                                        <td><?= ucfirst($reservation['status']) ?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                            </a>
                                            <a href="/admin/reservations/edit?id=<?= $reservation['id'] ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
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