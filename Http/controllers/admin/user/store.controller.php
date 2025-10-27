<?php

use Core\App;
use Http\Forms\AddUserForm;
use Http\Models\User;

$userForm = AddUserForm::validate($_POST);

$user = App::resolve(User::class)->fetchUserByEmail($_POST['email']);
if ($user) {
    $userForm->error(
        "email",
        "The email provided already exist."
    )->throw();
}

$salt = generateSalt();
$password = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT);

$newUser = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password' => $password,
    'salt' => $salt,
    'type' => $_POST['type']
];

App::resolve(User::class)->createUser($newUser);

redirect("/admin/users");
