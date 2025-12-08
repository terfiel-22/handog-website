<?php

use Core\App;
use Http\Forms\ContactDetailsForm;
use Http\Models\ContactDetails;

ContactDetailsForm::validate($_POST);

unset($_POST["_method"]);

if (empty($_POST["id"])) {
    unset($_POST["id"]);
    App::resolve(ContactDetails::class)->createSocialDetail($_POST);
} else {
    App::resolve(ContactDetails::class)->updateSocialDetail($_POST);
}

redirect('/admin/settings/contact_details');
