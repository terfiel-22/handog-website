 <?php

  /** ACCESSIBLE TO GUEST */
  $router->get('/', 'guest/index.controller.php')->only('guest');
