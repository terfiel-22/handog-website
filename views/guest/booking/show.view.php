<!DOCTYPE html>
<html lang="en">

<!--<< Header Area >>-->
<?php view("guest/partials/head.partial.php", [
    'title' => "Handog | Booking"
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

    <!-- GT Booking Payment Result -->
    <section class="gt-contacts-section section-padding fix">
        <div class="container">
            <div class="gt-contact-wrapper">
                <div class="row g-4">
                    <div class="col-12">
                        <?php if ($payment["payment_status"] == \Http\Enums\PaymentStatus::UNPAID): ?>
                            <div class="gt-contact-right-items text-center">
                                <h2>
                                    Your Reservation is Saved!
                                </h2>
                                <p>
                                    Complete your booking by making the payment. Click below to continue.
                                </p>
                                <a href="<?= $payment["payment_link"] ?>" target="_blank" rel="noopener noreferrer" class="gt-theme-btn mt-5">Go to Payment</a>
                            </div>
                        <?php endif; ?>
                        <?php if ($payment["payment_status"] == \Http\Enums\PaymentStatus::PAID): ?>
                            <div class="gt-contact-right-items text-center">
                                <h2>
                                    Payment Successful!
                                </h2>
                                <p>
                                    Thank you for completing your payment. Your booking is now confirmed — we can&apos;t wait to welcome you!
                                </p>
                                <a href="/" class="gt-theme-btn mt-5">Back to Home</a>
                            </div>
                        <?php endif; ?>
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