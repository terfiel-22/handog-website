<?php

use Core\App;
use Http\Forms\ForgotPasswordForm;
use Http\Models\User;
use Http\Services\ResetPasswordService;

$forgotPasswordForm = ForgotPasswordForm::validate($_POST);

// Check if email exist
$user = App::resolve(User::class)->fetchUserByEmail($_POST["email"]);
if (!$user) {
    $forgotPasswordForm->error(
        "email",
        "No account is associated with this email."
    )->throw();
}

// Create reset PIN 
$reset_pin = ResetPasswordService::generateResetPin();

// Update Reset Pin on User
App::resolve(User::class)->updateResetPin($user["id"], compact("reset_pin"));

// Send email
ResetPasswordService::emailResetPin($user["email"], $user["username"], $reset_pin);

redirect("/reset-password/show");
