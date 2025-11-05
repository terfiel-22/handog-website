<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\PasswordForm;
use Http\Forms\UpdateUserForm;
use Http\Models\User;

// Check if gallery image exists
$origUser = App::resolve(User::class)->fetchUserById($_POST["id"]);

$existingImage = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existingImage[0] ?? $_FILES["images"]["name"][0];

// Validate Form
UpdateUserForm::validate($_POST);

if (reset($existingImage) != $_POST["image"]) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
    $_POST["image"] = reset($fileuploadResult);

    // Delete old image
    if (isset($origUser["image"]))
        App::resolve(FileUploadHandler::class)->deleteFile($origUser["image"]);
} else {
    $_POST["image"] = $origUser["image"];
}

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
unset($_POST["existing_images"]);

App::resolve(User::class)->updateUser($origUser["id"], $_POST);
/** END Update User Data on Database **/

redirect("/admin/users");
