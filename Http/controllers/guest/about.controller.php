<?php

use Core\Session;

$errors = Session::get('errors', []);

view(
    "guest/about.view.php",
    compact("errors")
);
