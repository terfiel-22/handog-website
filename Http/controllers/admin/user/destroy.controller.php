<?php

use Core\App;
use Http\Models\User;

$user = App::resolve(User::class)->fetchUserById($_POST["item_id"]);

App::resolve(User::class)->deleteUser($user["id"]);

redirect("/admin/users");
