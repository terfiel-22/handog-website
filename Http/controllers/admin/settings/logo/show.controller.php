<?php

use Core\App;
use Core\Session;
use Http\Models\Logo;

$logo = App::resolve(Logo::class)->fetchLogo();
if (!$logo) {
    $logo = ['id' => 1, 'image' => 'assets/guest/img/logo/black-logo.svg'];
}

$readableImagePaths[] = handleImage($logo["image"]);

$errors = Session::get('errors', []);

view(
    "admin/settings/logo/show.view.php",
    compact('logo', 'readableImagePaths', 'errors')
);
