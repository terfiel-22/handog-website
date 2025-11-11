<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/reset_password/show.view.php",
    compact("errors")
);
