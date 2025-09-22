<?php

/** Function for displaying variables */
function dd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}

/** Function for getting base_path */
function base_path($path)
{
    return BASE_PATH . $path;
}

/** Function for redirecting to a certain path. */
function redirect($path = null)
{
    $url = $path ?? $_COOKIE['uri'] ?? '/';
    header("location: $url");
    die();
}

/** Function for directly importing file from view folder */
function view($path, $attributes = []): void
{
    extract($attributes);
    require base_path("views/" . $path);
}

/** Function for displaying error in browser */
function abort($code = 404)
{
    http_response_code($code);
    require base_path("/views/errors/$code.view.php");
    die();
}

/** Convert number into currency number format */
function moneyFormat($value)
{
    return "₱ " . number_format($value, 2);
}

/** Function for getting old form data */
function old($key,  $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}
