<?php

namespace Core;

use Core\Middlewares\Middleware;

class Router
{
    public $routes = [];

    public function add(string $method, string $uri, string $controller): self
    {
        $middleware = null;

        $this->routes[] = compact(
            'uri',
            'controller',
            'method',
            'middleware'
        );

        return $this;
    }

    public function get(string $uri, string $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete(string $uri, string $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }
    public function patch(string $uri, string $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }
    public function put(string $uri, string $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only(string $key): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === strtoupper($method)) {

                $expiration = 60 * 60 * 24; // 1 day
                $params = session_get_cookie_params();
                setcookie(
                    'uri',
                    $_SERVER['REQUEST_URI'],
                    time() + $expiration,
                    $params['path'],
                    $params['domain'],
                    $params['httponly']
                );

                (new Middleware)->resolve($route['middleware']);

                require base_path("Http/controllers/" . $route['controller']);
                Session::unflash();

                die();
            }
        }

        $this->abort();
    }

    public function previousUrl(): string
    {
        return $_COOKIE['uri'] ?? '/';
    }

    protected function abort(int $code = 404): void
    {
        http_response_code($code);
        require base_path("views/errors/$code.view.php");
        die();
    }
}
