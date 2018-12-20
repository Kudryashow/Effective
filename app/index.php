<?php

require 'vendor/autoload.php';
//use application\core\Router;

session_start();
$config = new \application\services\ConfigService;
//$router = new Router;
$app = new \application\core\Application();
//$router->run();
$app->run();