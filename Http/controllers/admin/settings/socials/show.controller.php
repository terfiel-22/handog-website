<?php

use Core\Session;
use Http\Services\SocialService;

$socials = SocialService::getSocialDetails();
$errors = Session::get('errors', []);

view(
    "admin/settings/socials/show.view.php",
    compact('socials', 'errors')
);
