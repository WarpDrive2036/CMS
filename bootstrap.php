<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container(); // Instantiated the Class / Created an Object from the Class

$container->bind('Database',function (){ // binding the DB Service Class
    $config = require base_path('config.php');
    return new Database($config['database']);
});

$db = $container->resolve('Database'); // Resolving/Returning the DB Object

App::setContainer($container);






