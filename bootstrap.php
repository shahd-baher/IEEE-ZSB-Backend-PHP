<?php

use Core\App;
use Core\Conatiner;
use Core\Database;

$container = new Conatiner();
$container->bind('Core\Database', function () {
    $config = require base_path("config.php");

    return new Database($config['database']);
});

App::setContainer($container);