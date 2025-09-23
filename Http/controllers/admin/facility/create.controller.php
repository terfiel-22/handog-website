<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/facility/create.view.php",
    compact('errors')
);
