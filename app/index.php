<?php

require 'vendor/autoload.php';
//use application\core\Router;
use application\core\Application;
session_start();
$services = include 'init/services.php';
//$router = new Router;
$app = new Application($services);
//$router->run();
$app->run();