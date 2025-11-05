<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\AddUserForm;
use Http\Models\User;

$_POST["image"] = $_FILES["images"]["name"][0];
$userForm = AddUserForm::validate($_POST);

$user = App::resolve(User::class)->fetchUserByEmail($_POST['email']);
if ($user) {
    $userForm->error(
        "email",
        "The email provided already exist."
    )->throw();
}

$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles(
    $_FILES['images']
);
if (!$fileuploadResult['success']) {
    $userForm->error(
        "image",
        "There's an error uploading image, try again."
    )->throw();
}

$salt = generateSalt();
$password = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT);

$newUser = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'image' => $fileuploadResult['success'][0],
    'password' => $password,
    'salt' => $salt,
    'type' => $_POST['type']
];

App::resolve(User::class)->createUser($newUser);

redirect("/admin/users");
