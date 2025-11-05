<?php

use Core\App;
use Http\Forms\PasswordForm;
use Http\Forms\UpdateUserForm;
use Http\Models\User;

// Check if gallery image exists
$origUser = App::resolve(User::class)->fetchUserById($_POST["id"]);

// Validate Form
UpdateUserForm::validate($_POST);
if (!empty($_POST["password"]) && !empty($_POST['cpassword'])) {
    PasswordForm::validate($_POST);

    $salt = generateSalt();
    $password = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT);
    $session_token = null;
    App::resolve(User::class)->updateUserPassword($origUser["id"], compact('password', 'salt', 'session_token'));
}

/** START Update User Data on Database **/
unset($_POST["_method"]);
unset($_POST["password"]);
unset($_POST["cpassword"]);

App::resolve(User::class)->updateUser($origUser["id"], $_POST);
/** END Update User Data on Database **/

redirect("/admin/users");
