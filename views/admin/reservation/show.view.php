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
                            <h6 class="text-lg fw-semibold mb-0">Reservation Information</h6>
                        </div>
                        <div class="card-body p-24">
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