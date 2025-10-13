<?php

namespace Core\Middlewares;

class Authenticated
{
    public function handle($user)
    {
        if (!$user) {
            header('location: /admin');
            die();
        }
    }
}
