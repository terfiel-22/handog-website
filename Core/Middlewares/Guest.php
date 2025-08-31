<?php

namespace Core\Middlewares;

class Guest
{
    public function handle($user)
    {
        if ($user) {
            header('location: /');
            die();
        }
    }
}
