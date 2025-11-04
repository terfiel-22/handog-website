<?php
$pageName = "Terms & Conditions"
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

            <!-- Data -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Modify Terms & Conditions</h6>
                </div>

                <div class="card-body">
                    <form class="row gy-3" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $terms['id'] ?>">
                        <div class="col-12">
                            <iframe id="pdfViewer" frameborder="0" width="100%" height="600px"></iframe>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="file">Upload New</label>
                            <input type="file" name="file" id="file" class="form-control" accept="application/pdf">
                            <?php if (isset($errors["file"])) : ?>
                                <div class="error-text">
                                    <?= $errors["file"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 g-5">
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
        $(document).ready(function() {
            // Load initial PDF from PHP path
            const pdfUrl = "<?= $terms['file'] ?>";
            $('#pdfViewer').attr('src', pdfUrl);

            // When a file is selected
            $("#file").change(function(event) {
                const file = event.target.files[0];
                if (file && file.type === "application/pdf") {
                    const fileURL = URL.createObjectURL(file);
                    $('#pdfViewer').attr('src', fileURL);
                } else {
                    alert("Please select a valid PDF file.");
                    $(this).val('');
                }
            });
        });
    </script>
</body>

</html>