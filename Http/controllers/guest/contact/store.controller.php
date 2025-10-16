<?php

use Core\App;
use Http\Forms\ContactForm;
use Http\Helpers\ContactHelper;

ContactForm::validate($_POST);

// Send email to website owner
App::resolve(ContactHelper::class)->sendEmailForGuestConcern($_POST);

redirect("/");
