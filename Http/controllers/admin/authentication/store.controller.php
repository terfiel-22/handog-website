<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$loginForm = LoginForm::validate($_POST);

$signedIn = (new Authenticator)->attempt($_POST);

if (!$signedIn) {
    $loginForm->error(
        "password",
        "Please provide a valid credentials that matched your account."
    )->throw();
}

if (isset($_POST['remember'])) {
    Session::put('email', $_POST['email']);
    Session::put('password', $_POST['password']);
}

return redirect('/admin/dashboard');
