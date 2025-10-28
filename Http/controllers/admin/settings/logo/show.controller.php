<?php

$logo = ['id' => 1, 'image' => 'assets/guest/img/logo/black-logo.svg'];
$readableImagePaths[] = handleImage($logo["image"]);

view(
    "admin/settings/logo/show.view.php",
    compact('logo', 'readableImagePaths')
);
