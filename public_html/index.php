<?php

use Core\ValidationException;
use Core\Session;

date_default_timezone_set('Asia/Manila');

session_start();

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "vendor/autoload.php";
require BASE_PATH . "Core/functions.php";
require BASE_PATH . "Core/Constant.php";

require base_path("bootstrap.php");

$router = new Core\Router();
require base_path("routes.php");

$uri = parse_url($_SERVER['REQUEST_URI'])["path"];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {

    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}
