<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$loginForm = LoginForm::validate($_POST);

$signedIn = (new Authenticator)->attempt($_POST);

if (!$signedIn) {
    $loginForm->error(
        "password",
        "Please provide a valid credentials that matched your account."
    )->throw();
}
