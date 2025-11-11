<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/reset_password/index.view.php",
    compact("errors")
);
