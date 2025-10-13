<?php

use Core\Session;


$credentials = [
    'email' => Session::get('email', ''),
    'password' => Session::get('password', ''),
];

$errors = Session::get('errors', []);

view(
    "admin/authentication/index.view.php",
    compact('credentials', 'errors')
);
