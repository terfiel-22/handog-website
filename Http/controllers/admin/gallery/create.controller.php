<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/gallery/create.view.php",
    compact('errors')
);
