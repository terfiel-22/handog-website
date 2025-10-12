<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Events"
]) ?>

<body>
    <!-- Preloader Start -->
    <?php view("guest/partials/preloader.partial.php") ?>

    <!-- Misc Section -->
    <?php view("guest/partials/misc.partial.php") ?>

    <!-- Offcanvas Area Start -->
    <?php view("guest/partials/off_canvas.partial.php") ?>

    <!-- Header Section Start -->
    <?php view("guest/partials/header.partial.php") ?>

    <!-- Breadcrumb Section Start -->
    <?php view("guest/partials/breadcrumb.partial.php", [
        'pageName' => "Event"
    ]) ?>

    <!-- GT Event Start -->
    <section class="news-standard-section section-padding">
        <div class="container">
            <div class="gt-news-details-wrapper">
                <div class="row g-4">
                    <div class="col-12 col-lg-8">
                        <div class="gt-details-image">
                            <img src="<?= handleImage($event["image"], "/assets/guest/img/home-1/news/details-1.jpg") ?>" alt="<?= $event["name"] ?>">
                        </div>
                        <div class="gt-news-details-content">
                            <h3><?= $event["name"] ?></h3>
                            <p><?= $event["description"] ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="gt-main-sideber sticky-style">
                            <div class="gt-single-sideber-widget">
                                <div class="gt-widget-title">
                                    <h3>Upcoming Events</h3>
                                </div>
                                <div class="gt-recent-post-area">
                                    <?php if (!empty($upcomingEvents)): ?>
                                        <?php foreach ($upcomingEvents as $upcomingEvent): ?>
                                            <?php if ($upcomingEvent["id"] == $event["id"]) continue; ?>
                                            <div class="gt-recent-items">
                                                <div class="gt-recent-thumb upcoming-event">
                                                    <img src="<?= handleImage($upcomingEvent["image"], "/assets/guest/img/home-1/news/post-1.jpg") ?>" alt="<?= $upcomingEvent["name"] ?>">
                                                </div>
                                                <div class="gt-recent-content">
                                                    <h5>
                                                        <a href="/event?id=<?= $upcomingEvent["id"] ?>">
                                                            <?= $upcomingEvent["name"] ?>
                                                        </a>
                                                    </h5>
                                                    <ul>
                                                        <li>
                                                            <?= formatDatetimeToReadable($upcomingEvent["date"]) ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No upcoming events.</p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GT Footer Section Start -->
    <?php view("guest/partials/footer.partial.php") ?>

    <!--<< All JS Plugins >>-->
    <?php view("guest/partials/plugins.partial.php") ?>
</body>

</html>