 <?php

    /** ACCESSIBLE TO GUEST */
    $router->get('/', 'guest/index.controller.php')->only('guest');

    /** ACCESSIBLE TO ADMIN */
    $router->get('/admin', 'admin/index.controller.php')->only('guest'); //TODO: Create new middleware for admin
