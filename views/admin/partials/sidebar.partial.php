<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="/admin" class="sidebar-logo">
            <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo()["image"], "/assets/admin/images/logo.png") ?>" alt="site logo" class="light-logo">
            <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo()["image"], "/assets/admin/images/logo-light.png") ?>" alt="site logo" class="dark-logo">
            <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo()["icon"], "/assets/admin/images/logo-icon.png") ?>" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="/admin/dashboard">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/reservations">
                    <iconify-icon icon="ic:outline-bookmarks" class="menu-icon"></iconify-icon>
                    <span>Reservations</span>
                </a>
            </li>
            <?php if (\Http\Services\UserService::getCurrentUser()["type"] == \Http\Enums\UserType::ADMIN): ?>
                <li>
                    <a href="/admin/facilities">
                        <iconify-icon icon="ic:outline-home" class="menu-icon"></iconify-icon>
                        <span>Facilities</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/amenities">
                        <iconify-icon icon="ic:outline-pool" class="menu-icon"></iconify-icon>
                        <span>Amenities</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/gallery">
                        <iconify-icon icon="ic:outline-image" class="menu-icon"></iconify-icon>
                        <span>Gallery</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/events">
                        <iconify-icon icon="ic:outline-event" class="menu-icon"></iconify-icon>
                        <span>Events</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/faqs">
                        <iconify-icon icon="ic:outline-question-mark" class="menu-icon"></iconify-icon>
                        <span>FAQs</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/users">
                        <iconify-icon icon="ic:outline-people" class="menu-icon"></iconify-icon>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/promos">
                        <iconify-icon icon="ic:outline-card-giftcard" class="menu-icon"></iconify-icon>
                        <span>Promos</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/testimonials">
                        <iconify-icon icon="ic:outline-message" class="menu-icon"></iconify-icon>
                        <span>Testimonials</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="ic:outline-settings" class="menu-icon"></iconify-icon>
                        <span>Settings</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="/admin/settings/rates"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Rates</a>
                        </li>
                        <li>
                            <a href="/admin/settings/logo"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Logo</a>
                        </li>
                        <li>
                            <a href="/admin/settings/terms-conditions"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Terms & Conditions</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <!-- <li class="sidebar-menu-group-title">Reservations</li>
            <li>
                <a href="javascript:void(0)">
                    <iconify-icon icon="material-symbols:room-service-outline-sharp" class="menu-icon"></iconify-icon>
                    <span>Rooms</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <iconify-icon icon="material-symbols:cottage-outline" class="menu-icon"></iconify-icon>
                    <span>Cottages</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <iconify-icon icon="ic:outline-home" class="menu-icon"></iconify-icon>
                    <span>Event Hall</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <iconify-icon icon="ic:outline-home-work" class="menu-icon"></iconify-icon>
                    <span>Exclusive</span>
                </a>
            </li>

            <li class="sidebar-menu-group-title">Amenities</li>
            <li>
                <a href="/admin/pools">
                    <iconify-icon icon="ic:outline-pool" class="menu-icon"></iconify-icon>
                    <span>Pools</span>
                </a>
            </li>
            <li>
                <a href="/admin/grillers">
                    <iconify-icon icon="ic:outline-outdoor-grill" class="menu-icon"></iconify-icon>
                    <span>Grillers</span>
                </a>
            </li>
            <li>
                <a href="/admin/shower-rooms">
                    <iconify-icon icon="ic:outline-shower" class="menu-icon"></iconify-icon>
                    <span>Shower Rooms</span>
                </a>
            </li>

            <li class="sidebar-menu-group-title">Web</li>
            <li>
                <a href="/admin/shower-rooms">
                    <iconify-icon icon="ic:outline-image-search" class="menu-icon"></iconify-icon>
                    <span>Gallery</span>
                </a>
            </li>
            <li>
                <a href="/admin/promotions">
                    <iconify-icon icon="ic:outline-card-giftcard" class="menu-icon"></iconify-icon>
                    <span>Promotion</span>
                </a>
            </li>
            <li>
                <a href="/admin/upcoming-events">
                    <iconify-icon icon="ic:round-edit-calendar" class="menu-icon"></iconify-icon>
                    <span>Upcoming Events</span>
                </a>
            </li>
            <li>
                <a href="/admin/testimonials">
                    <iconify-icon icon="ic:outline-message" class="menu-icon"></iconify-icon>
                    <span>Testimonials</span>
                </a>
            </li>
            <li>
                <a href="/admin/about">
                    <iconify-icon icon="ic:outline-announcement" class="menu-icon"></iconify-icon>
                    <span>About</span>
                </a>
            </li> -->
        </ul>
    </div>
</aside>