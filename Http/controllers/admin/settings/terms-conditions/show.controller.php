<?php

use Core\Session;

$filepath = "assets/default/sample-terms-conditions-agreement.pdf";
$terms = [];
$terms['file'] = handleFilePath($filepath);
$terms['id'] = 1;

$errors = Session::get('errors', []);

view(
    "admin/settings/terms-conditions/show.view.php",
    compact('terms', 'errors')
);
