<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/authentication/index.view.php",
    compact('errors')
);
