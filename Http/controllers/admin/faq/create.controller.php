<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "admin/faq/create.view.php",
    compact('errors')
);
