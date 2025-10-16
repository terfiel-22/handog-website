<?php

use Core\App;
use Http\Forms\ContactForm;
use Http\Helpers\ContactHelper;
use Http\Models\Message;

ContactForm::validate($_POST);

// Save to Database
App::resolve(Message::class)->createMessage($_POST);

// Send email to website owner
App::resolve(ContactHelper::class)->sendEmailForGuestConcern($_POST);

redirect("/");
