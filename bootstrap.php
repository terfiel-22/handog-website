<?php

use Core\App;
use Core\Container;

$container = new Container();

/** Add all key(class name) value(resolver/function for class initialization) pair */
// Example
// $container->bind(Database::class, function () {
//     $config = require base_path("config.php");
//     return new Database($config['database']);
// });

App::setContainer($container);
