<?php

use Core\App;
use Http\Forms\ContactForm;
use Http\Models\Email;

ContactForm::validate($_POST);

// Save to Database
App::resolve(Email::class)->createEmail($_POST);

// Send email to website owner

redirect("/");
