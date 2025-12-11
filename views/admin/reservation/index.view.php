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
                                    <th scope="col">Check In</th>
                                    <th scope="col">Check Out</th>
                                    <th scope="col">With Videoke</th>
                                    <th scope="col">Total Rate</th>
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
                                        <td><?= formatDatetimeToReadable($reservation['check_in']) ?></td>
                                        <td><?= formatDatetimeToReadable($reservation['check_out']) ?></td>
                                        <td><?= ucfirst($reservation['rent_videoke']) ?></td>
                                        <td><?= moneyFormat($reservation['total_price']) ?></td>
                                        <td><?= moneyFormat($reservation['paid_amount']) ?></td>
                                        <td><?= moneyFormat($reservation['total_price'] - $reservation['paid_amount']) ?></td>
                                        <td><?= ucfirst($reservation['status']) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="/admin/reservations/show?id=<?= $reservation['id'] ?>" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                                </a>

                                                <?php if ($reservation["status"] != \Http\Enums\ReservationStatus::COMPLETED): ?>
                                                    <a href="/admin/reservations/edit?id=<?= $reservation['id'] ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                <?php endif; ?>

                                                <button
                                                    type="button"
                                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    onclick="deleteModalForm('/admin/reservations/destroy','<?= $reservation['id'] ?>')"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#al-warning-alert">
                                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Contact Person</th>
                                    <th scope="col">Guest Count</th>
                                    <th scope="col">Facility</th>
                                    <th scope="col">Check In</th>
                                    <th scope="col">Check Out</th>
                                    <th scope="col">With Videoke</th>
                                    <th scope="col">Total Rate</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
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
        new DataTable('#dataTable', {
            ordering: false,
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        let column = this;
                        let title = column.footer().textContent;

                        if (title == "Action") return;
                        let input = document.createElement('input');
                        input.placeholder = title;
                        column.footer().replaceChildren(input);

                        input.addEventListener('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    });


                var r = $('#dataTable tfoot tr');
                r.find('th').each(function() {
                    $(this).css('padding', 8);
                });
                $('#dataTable thead').html(r);
                $('#search_0').css('text-align', 'center');
            },
        });
    </script>

</body>

</html>