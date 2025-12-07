<?php

use Core\App;
use Http\Forms\SocialDetailsForm;
use Http\Models\SocialDetails;

SocialDetailsForm::validate($_POST);

unset($_POST["_method"]);

if (empty($_POST["id"])) {
    unset($_POST["id"]);
    App::resolve(SocialDetails::class)->createSocialDetail($_POST);
} else {
    App::resolve(SocialDetails::class)->updateSocialDetail($_POST);
}

redirect('/admin/settings/socials');
