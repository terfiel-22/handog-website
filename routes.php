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

  // Reservation 
  $router->get('/admin/reservations', 'admin/reservation/index.controller.php')->only('guest');
  $router->get('/admin/reservations/add', 'admin/reservation/store.controller.php')->only('guest');
