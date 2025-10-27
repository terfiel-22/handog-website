<?php

namespace Core\Middlewares;

use Http\Services\UserService;

class Middleware
{
    public const MAP = [
        "admin" => Admin::class,
        "authenticated" => Authenticated::class,
        "guest" => Guest::class,
    ];

    public function resolve($key): void
    {
        if (!$key) return;

        if (!array_key_exists($key, static::MAP)) throw new \ErrorException("No matching middleware for key `$key`.");

        $middleware = static::MAP[$key];

        (new $middleware)->handle(
            UserService::getCurrentUser()
        );
    }
}
