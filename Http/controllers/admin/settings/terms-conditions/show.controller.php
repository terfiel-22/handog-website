<?php

use Core\App;
use Core\Session;
use Http\Models\TermsConditions;

$terms = App::resolve(TermsConditions::class)->fetchTermsConditions();
if (!$terms) {
    $terms['filepath'] = handleFilePath(TERMS_CONDITIONS_PATH);
    $terms['id'] = null;
} else {
    $terms['filepath'] = handleFilePath($terms['filepath']);
}

$errors = Session::get('errors', []);

view(
    "admin/settings/terms-conditions/show.view.php",
    compact('terms', 'errors')
);
