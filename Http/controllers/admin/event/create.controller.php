<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/event/create.view.php",
    compact('errors')
);
