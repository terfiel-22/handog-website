<?php

use Core\App;
use Http\Enums\YesNo;
use Http\Forms\PasswordForm;
use Http\Models\User;

$passwordForm = PasswordForm::validate($_POST);

// Get user based on email
$email = get_cookie('new_account_email');
if (!$email) {
    $passwordForm->error(
        "cpassword",
        "Error occured. Please try to login again."
    )->throw();
}

$user = App::resolve(User::class)->fetchUserByEmail($email);
if (!$user) {
    $passwordForm->error(
        "cpassword",
        "Error occured. The current account does not exist."
    )->throw();
}

$salt = generateSalt();
$password = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT);
$session_token = generateSessionToken($user["id"]);
$reset_pin = null;

create_cookie('session_token', $session_token);
destroy_cookie('new_account_email');
App::resolve(User::class)->updateUserPassword($user["id"], compact('password', 'salt', 'session_token', 'reset_pin'));
App::resolve(User::class)->updateUserFirstTimeLogin($user["id"], ["first_time_login" => YesNo::NO]);

redirect("/admin");
