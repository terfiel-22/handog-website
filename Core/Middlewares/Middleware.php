<?php

namespace Core\Middlewares;

use Core\App;
use Http\Models\User;

class Middleware
{
    public const MAP = [
        "admin" => Authenticated::class,
        "guest" => Guest::class,
    ];

    public function resolve($key): void
    {
        if (!$key) return;

        if (!array_key_exists($key, static::MAP)) throw new \ErrorException("No matching middleware for key `$key`.");

        $middleware = static::MAP[$key];

        (new $middleware)->handle(
            $this->getCurrentUser()
        );
    }

    private function getCurrentUser()
    {
        if (!isset($_COOKIE['session_token'])) return false;
        $sessionToken = $_COOKIE['session_token'];

        return App::resolve(User::class)->fetchUserBySessionToken($sessionToken);
    }
}
