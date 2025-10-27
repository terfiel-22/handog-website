<?php

use Core\App;
use Core\Session;
use Http\Models\User;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$user = App::resolve(User::class)->fetchUserById($id);

view(
    "admin/user/edit.view.php",
    compact('user', 'errors')
);
