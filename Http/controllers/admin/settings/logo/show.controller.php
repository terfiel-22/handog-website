<?php

use Core\Session;
use Http\Services\SettingService;

$logo = SettingService::getLogo();

$readableLogo[] = handleFilePath($logo["logo"]);
$readableIcon[] = handleFilePath($logo["icon"]);

$errors = Session::get('errors', []);

view(
    "admin/settings/logo/show.view.php",
    compact('logo', 'readableLogo', 'readableIcon', 'errors')
);
