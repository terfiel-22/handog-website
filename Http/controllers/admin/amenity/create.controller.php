<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/promo/create.view.php",
    compact('errors')
);
