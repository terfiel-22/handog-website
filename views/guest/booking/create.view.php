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

    <!-- Booking Form -->
    <section class="gt-contacts-section section-padding fix">
        <div class="container">
            <div class="gt-contact-wrapper">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="gt-contact-right-items">
                            <h2>
                                Book a reservation
                            </h2>
                            <p>Complete filling up the form to continue.</p>
                            <form action="#" id="contact-form" class="booking">
                                <h4 class="fw-bold">Contact Information</h4>
                                <div class="row g-4 align-items-center">
                                    <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                        <label for="contact_person">Full Name</label>
                                        <div class="form-clt">
                                            <input type="text" name="contact_person" id="contact_person" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                                        <label for="contact_email">Email</label>
                                        <div class="form-clt">
                                            <input type="email" name="contact_email" id="contact_email" placeholder="Your Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                        <label for="contact_no">Phone Number</label>
                                        <div class="form-clt">
                                            <input type="tel" name="contact_no" id="contact_no" placeholder="Your Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                        <label for="contact_address">Address</label>
                                        <div class="form-clt">
                                            <input type="text" name="contact_address" id="contact_address" placeholder="Your Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 wow fadeInUp" data-wow-delay=".5s">
                                        <button type="submit" class="gt-theme-btn">PROCEED</button>
                                    </div>
                                </div>
                            </form>
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