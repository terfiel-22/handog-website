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
