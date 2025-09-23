 <?php

  /** ACCESSIBLE TO GUEST */
  $router->get('/', 'guest/index.controller.php')->only('guest');
  $router->get('/accommodation', 'guest/accommodation.controller.php')->only('guest');
  $router->get('/amenities', 'guest/amenities.controller.php')->only('guest');
  $router->get('/gallery', 'guest/gallery.controller.php')->only('guest');
  $router->get('/about', 'guest/about.controller.php')->only('guest');
  $router->get('/facility', 'guest/facility.controller.php')->only('guest');


  /** ACCESSIBLE TO ADMIN */
  $router->get('/admin', 'admin/index.controller.php')->only('guest'); //TODO: Create new middleware for admin

  // Facility
  $router->get('/admin/facilities', 'admin/facility/index.controller.php')->only('guest');
  $router->get('/admin/facilities/create', 'admin/facility/create.controller.php')->only('guest');
  $router->post('/admin/facilities/store', 'admin/facility/store.controller.php')->only('guest');

  // Reservation 
  $router->get('/admin/reservations', 'admin/reservation/index.controller.php')->only('guest');
  $router->get('/admin/reservations/create', 'admin/reservation/create.controller.php')->only('guest');
  $router->post('/admin/reservations/store', 'admin/reservation/store.controller.php')->only('guest');

  // Settings
  $router->get('/admin/settings/rates', 'admin/settings/rates/show.controller.php')->only('guest');
  $router->put('/admin/settings/rates', 'admin/settings/rates/update.controller.php')->only('guest');
