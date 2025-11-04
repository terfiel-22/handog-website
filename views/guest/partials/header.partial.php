<header id="header-sticky" class="header-1 header-2">
    <div class="container-fluid">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="logo">
                    <a href="/" class="header-logo">
                        <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo()["image"], "/assets/guest/img/logo/white-logo.svg") ?>" alt="logo-img" />
                    </a>
                    <a href="/" class="header-logo-2">
                        <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo()["image"], "/assets/guest/img/logo/black-logo.svg") ?>" alt="logo-img" />
                    </a>
                </div>
                <div class="mean__menu-wrapper">
                    <div class="main-menu">
                        <nav id="mobile-menu">
                            <ul>
                                <li class="active menu-thumb">
                                    <a href="/">Home</a>
                                </li>
                                <li class="active d-xl-none">
                                    <a href="/" class="border-none">Home</a>
                                </li>
                                <li>
                                    <a href="/accommodation">Accommodation</a>
                                </li>
                                <li>
                                    <a href="/amenities">Amenities</a>
                                </li>
                                <li>
                                    <a href="/gallery">Gallery</a>
                                </li>
                                <li>
                                    <a href="/about">About Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div
                    class="header-right d-flex justify-content-end align-items-center">
                    <div class="header__hamburger my-auto">
                        <div class="sidebar__toggle">
                            <div class="header-bar">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="hero-button">
                        <a href="/booking" class="gt-theme-btn">BOOKING ONLINE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>