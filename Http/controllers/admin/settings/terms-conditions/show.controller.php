<?php

use Core\Session;

$terms = [];
$terms['file'] = handleFilePath(TERMS_CONDITIONS_PATH);
$terms['id'] = 1;

$errors = Session::get('errors', []);

view(
    "admin/settings/terms-conditions/show.view.php",
    compact('terms', 'errors')
);
