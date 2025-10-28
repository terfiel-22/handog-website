<?php

use Core\Session;
use Http\Services\SettingService;

$logo = SettingService::getLogo();

$readableImagePaths[] = handleImage($logo["image"]);

$errors = Session::get('errors', []);

view(
    "admin/settings/logo/show.view.php",
    compact('logo', 'readableImagePaths', 'errors')
);
