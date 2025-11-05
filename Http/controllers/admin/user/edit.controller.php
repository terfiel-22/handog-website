<?php

use Core\App;
use Core\Session;
use Http\Models\User;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$user = App::resolve(User::class)->fetchUserById($id);
$readableImagePaths[] = handleFilePath($user["image"] ?? USER_AVATAR_PATH);

view(
    "admin/user/edit.view.php",
    compact('user', 'readableImagePaths', 'errors')
);
