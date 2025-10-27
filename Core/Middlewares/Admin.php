<?php

namespace Core\Middlewares;

use Http\Enums\UserType;

class Admin
{
    public function handle($user)
    {
        if (!$user) {
            header('location: /admin');
            die();
        }
        if ($user["type"] != UserType::ADMIN) {
            header('location: /admin');
            die();
        }
    }
}
