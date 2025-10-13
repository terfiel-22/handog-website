<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/authentication/signin.view.php",
    compact('errors')
);
