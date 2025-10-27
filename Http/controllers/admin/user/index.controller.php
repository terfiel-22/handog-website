<?php

use Core\App;
use Http\Models\User;

$users = App::resolve(User::class)->fetchUsers();

view(
    "admin/user/index.view.php",
    compact('users')
);
