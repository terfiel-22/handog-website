 <?php

    /** START ACCESSIBLE TO ANYONE */
    $router->get('/', 'guest/index.controller.php');
    $router->get('/accommodation', 'guest/accommodation.controller.php');
    $router->get('/amenities', 'guest/amenities.controller.php');
    $router->get('/gallery', 'guest/gallery.controller.php');
    $router->get('/about', 'guest/about.controller.php');
    $router->get('/facility', 'guest/facility.controller.php');

    // Booking 
    $router->get('/booking', 'guest/booking/create.controller.php');
    $router->post('/booking/store', 'guest/booking/store.controller.php');
    $router->get('/booking/show', 'guest/booking/show.controller.php');

    //  Contact
    $router->post('/contact/store', 'guest/contact/store.controller.php');

    /** END ACCESSIBLE TO ANYONE */


    /** START ACCESSIBLE TO GUEST ADMIN */
    $router->get('/admin', 'admin/authentication/index.controller.php')->only('guest');
    $router->post('/admin', 'admin/authentication/store.controller.php')->only('guest');
    $router->delete('/admin', 'admin/authentication/destroy.controller.php')->only('authenticated');

    // Reset Password
    $router->get('/reset-password', 'admin/reset_password/index.controller.php')->only('guest');
    $router->post('/reset-password', 'admin/reset_password/store.controller.php')->only('guest');
    $router->get('/reset-password/show', 'admin/reset_password/show.controller.php')->only('guest');
    $router->put('/reset-password/show', 'admin/reset_password/update.controller.php')->only('guest');

    // First Time Login 
    $router->get('/new-account-reset-password', 'admin/new_account_reset_password/index.controller.php')->only('guest');
    $router->put('/new-account-reset-password', 'admin/new_account_reset_password/update.controller.php')->only('guest');
    /** END ACCESSIBLE TO GUEST ADMIN */


    /** ACCESSIBLE TO ADMIN & STAFF */
    // Dashboard
    $router->get('/admin/dashboard', 'admin/dashboard/index.controller.php')->only('authenticated');

    // Reservation 
    $router->get('/admin/reservations', 'admin/reservation/index.controller.php')->only('authenticated');
    $router->get('/admin/reservations/create', 'admin/reservation/create.controller.php')->only('authenticated');
    $router->post('/admin/reservations/store', 'admin/reservation/store.controller.php')->only('authenticated');
    $router->get('/admin/reservations/show', 'admin/reservation/show.controller.php')->only('authenticated');
    $router->get('/admin/reservations/edit', 'admin/reservation/edit.controller.php')->only('authenticated');
    $router->put('/admin/reservations/update', 'admin/reservation/update.controller.php')->only('authenticated');
    $router->delete('/admin/reservations/destroy', 'admin/reservation/destroy.controller.php')->only('authenticated');


    /** ACCESSIBLE TO ADMIN ONLY */

    // Facility
    $router->get('/admin/facilities', 'admin/facility/index.controller.php')->only('admin');
    $router->get('/admin/facilities/create', 'admin/facility/create.controller.php')->only('admin');
    $router->post('/admin/facilities/store', 'admin/facility/store.controller.php')->only('admin');
    $router->get('/admin/facilities/edit', 'admin/facility/edit.controller.php')->only('admin');
    $router->put('/admin/facilities/update', 'admin/facility/update.controller.php')->only('admin');
    $router->delete('/admin/facilities/destroy', 'admin/facility/destroy.controller.php')->only('admin');

    //   Amenities
    $router->get('/admin/amenities', 'admin/amenity/index.controller.php')->only('admin');
    $router->get('/admin/amenities/create', 'admin/amenity/create.controller.php')->only('admin');
    $router->post('/admin/amenities/store', 'admin/amenity/store.controller.php')->only('admin');
    $router->get('/admin/amenities/edit', 'admin/amenity/edit.controller.php')->only('admin');
    $router->put('/admin/amenities/update', 'admin/amenity/update.controller.php')->only('admin');
    $router->delete('/admin/amenities/destroy', 'admin/amenity/destroy.controller.php')->only('admin');

    //  Gallery
    $router->get('/admin/gallery', 'admin/gallery/index.controller.php')->only('admin');
    $router->get('/admin/gallery/create', 'admin/gallery/create.controller.php')->only('admin');
    $router->post('/admin/gallery/store', 'admin/gallery/store.controller.php')->only('admin');
    $router->get('/admin/gallery/edit', 'admin/gallery/edit.controller.php')->only('admin');
    $router->put('/admin/gallery/update', 'admin/gallery/update.controller.php')->only('admin');
    $router->delete('/admin/gallery/destroy', 'admin/gallery/destroy.controller.php')->only('admin');

    // Events
    $router->get('/admin/events', 'admin/event/index.controller.php')->only('admin');
    $router->get('/admin/events/create', 'admin/event/create.controller.php')->only('admin');
    $router->post('/admin/events/store', 'admin/event/store.controller.php')->only('admin');
    $router->get('/admin/events/edit', 'admin/event/edit.controller.php')->only('admin');
    $router->put('/admin/events/update', 'admin/event/update.controller.php')->only('admin');
    $router->delete('/admin/events/destroy', 'admin/event/destroy.controller.php')->only('admin');

    // Faqs 
    $router->get('/admin/faqs', 'admin/faq/index.controller.php')->only('admin');
    $router->get('/admin/faqs/create', 'admin/faq/create.controller.php')->only('admin');
    $router->post('/admin/faqs/store', 'admin/faq/store.controller.php')->only('admin');
    $router->get('/admin/faqs/edit', 'admin/faq/edit.controller.php')->only('admin');
    $router->put('/admin/faqs/update', 'admin/faq/update.controller.php')->only('admin');
    $router->delete('/admin/faqs/destroy', 'admin/faq/destroy.controller.php')->only('admin');

    // User
    $router->get('/admin/users', 'admin/user/index.controller.php')->only('admin');
    $router->get('/admin/users/create', 'admin/user/create.controller.php')->only('admin');
    $router->post('/admin/users/store', 'admin/user/store.controller.php')->only('admin');
    $router->get('/admin/users/edit', 'admin/user/edit.controller.php')->only('admin');
    $router->put('/admin/users/update', 'admin/user/update.controller.php')->only('admin');
    $router->delete('/admin/users/destroy', 'admin/user/destroy.controller.php')->only('admin');

    // Promo 
    $router->get('/admin/promos', 'admin/promo/index.controller.php')->only('admin');
    $router->get('/admin/promos/create', 'admin/promo/create.controller.php')->only('admin');
    $router->post('/admin/promos/store', 'admin/promo/store.controller.php')->only('admin');
    $router->get('/admin/promos/edit', 'admin/promo/edit.controller.php')->only('admin');
    $router->put('/admin/promos/update', 'admin/promo/update.controller.php')->only('admin');
    $router->delete('/admin/promos/destroy', 'admin/promo/destroy.controller.php')->only('admin');

    // Testimonial
    $router->get('/admin/testimonials', 'admin/testimonial/index.controller.php')->only('admin');
    $router->get('/admin/testimonials/create', 'admin/testimonial/create.controller.php')->only('admin');
    $router->post('/admin/testimonials/store', 'admin/testimonial/store.controller.php')->only('admin');
    $router->get('/admin/testimonials/edit', 'admin/testimonial/edit.controller.php')->only('admin');
    $router->put('/admin/testimonials/update', 'admin/testimonial/update.controller.php')->only('admin');
    $router->delete('/admin/testimonials/destroy', 'admin/testimonial/destroy.controller.php')->only('admin');

    //  Audit Trail
    $router->get('/admin/audit-trail', 'admin/audit_trail/index.controller.php')->only('admin');

    // Settings
    $router->get('/admin/settings/rates', 'admin/settings/rates/show.controller.php')->only('admin');
    $router->put('/admin/settings/rates', 'admin/settings/rates/update.controller.php')->only('admin');
    $router->get('/admin/settings/logo', 'admin/settings/logo/show.controller.php')->only('admin');
    $router->put('/admin/settings/logo', 'admin/settings/logo/update.controller.php')->only('admin');
    $router->get('/admin/settings/terms-conditions', 'admin/settings/terms-conditions/show.controller.php')->only('admin');
    $router->put('/admin/settings/terms-conditions', 'admin/settings/terms-conditions/update.controller.php')->only('admin');
    $router->get('/admin/settings/contact-details', 'admin/settings/contact_details/show.controller.php')->only('admin');
    $router->put('/admin/settings/contact-details', 'admin/settings/contact_details/update.controller.php')->only('admin');
    /** END ACCESSIBLE TO ADMIN */
