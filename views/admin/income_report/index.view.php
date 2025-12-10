<?php
$pageName = "Income Reports"
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
                    <h6 class="card-title mb-0">Payment Records</h6>
                </div>
                <div class="card-body">
                    <form class="mb-3">
                        <div class="row align-items-end">
                            <div class="col-12 col-md-3">
                                <label class="form-label" for="start_date">From</label>
                                <input type="text" name="start_date" id="start_date" class="form-control" value="<?= $start_date ?? date("Y-m-d") ?>">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label" for="end_date">To</label>
                                <input type="text" name="end_date" id="end_date" class="form-control" value="<?= $end_date ?? date("Y-m-d") ?>">
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-secondary">Filter</button>
                                <button type="button" id="printBtn" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Came From</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($incomeReports["payments"] as $payments): ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600"><?= $payments['id'] ?></a></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <h6 class="text-md mb-0 fw-medium flex-grow-1">Client</h6>
                                            </div>
                                        </td>
                                        <td>Taki Fimito</td>
                                        <td><?= formatDatetimeToReadable($payments["created_at"]) ?></td>
                                        <td><?= moneyFormat($payments["amount"]) ?></td>
                                        <td><?= ucfirst($payments["payment_status"]) ?></td>
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

    <script>
        $(document).ready(function() {
            $('#start_date, #end_date').flatpickr({
                dateFormat: "Y-m-d",
            });

            $("#printBtn").on('click', function() {
                const start_date = $("#start_date").val();
                const end_date = $("#end_date").val();

                const url = `/admin/income-reports/print?start_date=${start_date}&end_date=${end_date}`;
                window.open(url, "_blank");
            });
        });
    </script>

</body>

</html>