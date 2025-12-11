<div class="fix-area">
    <div class="offcanvas__info">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div
                    class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        <a href="/" class="logo-link">
                            <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo("/assets/guest/img/logo/white-logo.svg")["logo"]) ?>" alt="logo-img" />
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <p class="text d-none d-xl-block">
                    Welcome to Handog Resort, your sanctuary of relaxation and escape. Surrounded by nature&apos;s beauty and designed with comfort in mind, our resort offers the perfect blend of luxury and serenity. Whether you&apos;re here for a family getaway, a celebration, or simply to unwind, Handog Resort is where unforgettable memories begin.
                </p>
                <div class="mobile-menu fix mb-3"></div>
                <div class="offcanvas__contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <a target="_blank" href="#">
                                    <?= \Http\Services\ContactDetailService::getContactDetails()["address"] ?>
                                </a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div>
                                <a href="mailto:<?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?>">
                                    <?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?>
                                </a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div>
                                <a href="tel:<?= \Http\Services\ContactDetailService::getContactDetails()["contact_no"] ?>"><?= \Http\Services\ContactDetailService::getContactDetails()["contact_no"] ?></a>
                            </div>
                        </li>
                    </ul>
                    <div class="header-button mt-4"></div>
                    <a href="/booking" class="gt-theme-btn">BOOK NOW</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas__overlay"></div>