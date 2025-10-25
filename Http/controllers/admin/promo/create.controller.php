<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/amenity/create.view.php",
    compact('errors')
);
