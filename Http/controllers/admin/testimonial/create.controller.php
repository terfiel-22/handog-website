<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/testimonial/create.view.php",
    compact('errors')
);
