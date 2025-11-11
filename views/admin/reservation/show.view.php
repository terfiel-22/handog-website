<?php
$pageName = "Reservation"
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

            <div class="row g-4 justify-content-center">
                <!-- Reservation Details -->
                <div class="col-12 col-md-8">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <div class="d-flex align-items-center gap-2">
                                <a href="/admin/reservations" class="text-decoration-none d-flex align-items-center">
                                    <iconify-icon icon="mdi:arrow-left" width="22" class="me-1"></iconify-icon>
                                </a>
                                <h6 class="text-lg fw-semibold mb-0 ms-2">Reservation Information</h6>
                            </div>
                        </div>
                        <div class="card-body p-24">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-secondary-light fw-semibold">Contact Person</th>
                                    <td><?= htmlspecialchars($reservation['contact_person']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Contact Number</th>
                                    <td><?= htmlspecialchars($reservation['contact_no']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Email</th>
                                    <td><?= htmlspecialchars($reservation['contact_email']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Address</th>
                                    <td><?= htmlspecialchars($reservation['contact_address']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Check-In</th>
                                    <td><?= formatDatetimeToReadable($reservation['check_in']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Time Range</th>
                                    <td><?= htmlspecialchars($reservation['time_range']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Check-Out</th>
                                    <td><?= formatDatetimeToReadable($reservation['check_out']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Guest Count</th>
                                    <td><?= htmlspecialchars($reservation['guest_count']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Rent Videoke</th>
                                    <td><?= htmlspecialchars(ucfirst($reservation['rent_videoke'])) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Additional Bed</th>
                                    <td><?= htmlspecialchars(ucfirst($reservation['additional_bed_count'])) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Total Price</th>
                                    <td><?= moneyFormat((float)$reservation['total_price']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Status</th>
                                    <td><?= htmlspecialchars(ucfirst($reservation['status'])) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Payment Status</th>
                                    <td><?= htmlspecialchars(ucfirst($reservation['payment_status'])) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Paid Amount</th>
                                    <td><?= moneyFormat((float)$reservation['paid_amount']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Balance</th>
                                    <td><?= moneyFormat((float)$reservation['total_price'] - (float)$reservation['paid_amount']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Created At</th>
                                    <td><?= formatDatetimeToReadable($reservation['created_at']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-secondary-light fw-semibold">Updated At</th>
                                    <td><?= formatDatetimeToReadable($reservation['updated_at']) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Guest List -->
                <div class="col-12 col-md-4">
                    <div class="card h-100 p-0">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                            <h6 class="text-lg fw-semibold mb-0">Guests List</h6>
                        </div>

                        <div class="card-body p-24 overflow-auto" style="max-height: 75vh;">
                            <?php if (!empty($guests)): ?>
                                <ul class="list-group radius-8">
                                    <?php foreach ($guests as $guest): ?>
                                        <li class="list-group-item d-flex align-items-center justify-content-between border text-secondary-light bg-base">
                                            <table class="table table-sm table-borderless mb-0">
                                                <tr>
                                                    <th class="text-secondary-light fw-semibold">Name:</th>
                                                    <td><?= htmlspecialchars($guest['guest_name']) ?></td>
                                                </tr>

                                                <tr>
                                                    <th class="text-secondary-light fw-semibold">Age:</th>
                                                    <td><?= htmlspecialchars($guest['guest_age']) ?> yrs old</td>
                                                </tr>

                                                <tr>
                                                    <th class="text-secondary-light fw-semibold">Type:</th>
                                                    <td><?= htmlspecialchars(ucfirst($guest['guest_type'])) ?></td>
                                                </tr>

                                                <tr>
                                                    <th class="text-secondary-light fw-semibold">Senior/PWD:</th>
                                                    <td><?= htmlspecialchars(ucfirst($guest['senior_pwd'])) ?></td>
                                                </tr>
                                            </table>

                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">No guests found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>
</body>

</html>