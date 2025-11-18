<?php
$pageName = "Audit Trail"
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
                    <h6 class="card-title mb-0">List of Audit Logs</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Time | Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($audit_logs as $i => $audit_log): ?>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600"><?= $audit_log['id'] ?></a></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if (isset($audit_log["user_id"])): ?>
                                                    <h6 class="text-md mb-0 fw-medium"><?= $audit_log['username'] ?></h6>
                                                <?php else: ?>
                                                    <h6 class="text-md mb-0 fw-medium">Guest User</h6>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td><?= $audit_log['action'] ?></td>
                                        <td><?= $audit_log['module'] ?></td>
                                        <td><?= formatDatetimeToReadable($audit_log['created_at']) ?></td>

                                        <td>
                                            <div class="d-flex align-items-center gap-2">

                                                <button
                                                    type="button"
                                                    class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center viewAuditBtn"
                                                    data-index="<?= $i ?>">
                                                    <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
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

    <!-- Audit Modal -->
    <div class="modal fade" id="auditLogModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Audit Trail Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Username</th>
                            <td id="modal-username"></td>
                        </tr>
                        <tr>
                            <th>Activity</th>
                            <td id="modal-action"></td>
                        </tr>
                        <tr>
                            <th>Module</th>
                            <td id="modal-module"></td>
                        </tr>
                        <tr>
                            <th>Date & Time</th>
                            <td id="modal-created"></td>
                        </tr>
                        <tr>
                            <th>Old Value</th>
                            <td>
                                <ul id="modal-old"></ul>
                            </td>
                        </tr>

                        <tr>
                            <th>New Value</th>
                            <td>
                                <ul id="modal-new"></ul>
                            </td>
                        </tr>
                        <tr>
                            <th>User Agent</th>
                            <td id="modal-agent"></td>
                        </tr>
                        <tr>
                            <th>IP Address</th>
                            <td id="modal-ip"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>

    <?php view("admin/shared/delete-modal.php") ?>

    <script>
        let table = new DataTable('#dataTable', {
            ordering: false
        });
    </script>

    <!-- Display Data on Modal -->
    <script>
        $(document).ready(function() {
            // Inject audit_logs
            const auditLogs = <?= json_encode($audit_logs) ?>;

            // Get Modal
            const modalElement = document.getElementById('auditLogModal');
            const modal = new bootstrap.Modal(modalElement);

            // Helper 
            const formatDateTime = (value) => {
                if (!value) return "N/A";
                const date = new Date(value);
                if (isNaN(date)) return "N/A";
                return date.toLocaleString("en-US", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true,
                });
            };

            $(".viewAuditBtn").on("click", function() {
                const index = $(this).data("index");
                const auditLog = auditLogs[index];
                console.log(auditLog);

                $("#modal-username").text(auditLog.username);
                $("#modal-action").text(auditLog.action);
                $("#modal-module").text(auditLog.module);
                $("#modal-created").text(formatDateTime(auditLog.created_at));
                $("#modal-agent").text(auditLog.user_agent);
                $("#modal-ip").text(auditLog.ip_address);

                // Parse JSON for old/new values
                let oldValue = auditLog.old_value;
                let newValue = auditLog.new_value;
                try {
                    oldValue = JSON.parse(oldValue);
                } catch (e) {
                    oldValue = {};
                }

                try {
                    newValue = JSON.parse(newValue);
                } catch (e) {
                    newValue = {};
                }

                $("#modal-old").empty();
                $("#modal-new").empty();

                $.each(oldValue, function(key, value) {
                    $("#modal-old").append(`
                        <li class="list-group-item d-flex justify-content-between gap-2">
                            <strong>${key}:</strong> <span class="text-break">${value}</span>
                        </li>
                    `);
                });

                $.each(newValue, function(key, value) {
                    $("#modal-new").append(`
                        <li class="list-group-item d-flex justify-content-between gap-2">
                            <strong>${key}:</strong> <span class="text-break">${value}</span>
                        </li>
                    `);
                });

                modal.show();
            });
        });
    </script>

</body>

</html>