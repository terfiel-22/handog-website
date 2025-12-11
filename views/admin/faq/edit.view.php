<?php
$pageName = "Edit FAQ"
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
                    <form class="row gy-3" method="POST" action="/admin/faqs/update">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $faq["id"] ?>">
                        <div class="col-12">
                            <label class="form-label" for="question">Question *</label>
                            <textarea name="question" id="question" class="form-control" placeholder="Enter question"><?= $faq["question"] ?></textarea>
                            <?php if (isset($errors["question"])) : ?>
                                <div class="error-text">
                                    <?= $errors["question"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="answer">Answer *</label>
                            <textarea name="answer" id="answer" class="form-control" placeholder="Enter answer"><?= $faq["answer"] ?></textarea>
                            <?php if (isset($errors["answer"])) : ?>
                                <div class="error-text">
                                    <?= $errors["answer"] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 g-5">
                            <a href="/admin/faqs" class="btn btn-danger-600">Cancel</a>
                            <button type="submit" class="btn btn-primary-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Plugins -->
    <?php view("admin/partials/plugins.partial.php") ?>
</body>

</html>