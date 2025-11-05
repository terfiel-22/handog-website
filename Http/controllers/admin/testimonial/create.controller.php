<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/user/create.view.php",
    compact('errors')
);
