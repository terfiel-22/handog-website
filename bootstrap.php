<?php

use Core\App;
use Core\Container;
use Core\Database;
use Http\Models\Facility;

$container = new Container();

/** Add all key(class name) value(resolver/function for class initialization) pair */
$container->bind(Database::class, function () {
    $config = require base_path("config.php");
    return new Database($config['database']);
});

/** Models */
$container->bind(Facility::class, function () {
    return new Facility();
});

App::setContainer($container);
