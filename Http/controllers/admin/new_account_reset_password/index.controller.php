<?php

use Core\Session;

$email = get_cookie('new_account_email');
if (!$email) {
    redirect('/admin');
    die();
}

$errors = Session::get('errors', []);

view(
    "admin/new_account_reset_password/index.view.php",
    compact("errors")
);
