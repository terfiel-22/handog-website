<?php

namespace Core\Middlewares;

class Middleware
{
    public const MAP = [
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
        return null; // TODO: Fetch current user
    }
}
