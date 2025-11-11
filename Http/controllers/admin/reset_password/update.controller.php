<?php

use Core\App;
use Http\Forms\ResetPasswordForm;
use Http\Models\User;

$resetPasswordForm = ResetPasswordForm::validate($_POST);

$user = App::resolve(User::class)->fetchUserByResetPin($_POST["reset_pin"]);
if (!$user) {
    $resetPasswordForm->error(
        "reset_pin",
        "Please input correct PIN."
    )->throw();
}

$salt = generateSalt();
$password = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT);
$session_token = null;
$reset_pin = null;

App::resolve(User::class)->updateUserPassword($user["id"], compact('password', 'salt', 'session_token', 'reset_pin'));

redirect("/admin");
