<?php

require 'vendor/autoload.php';
use application\core\Router;
use application\services\ConfigService;

session_start();
$router = new Router;
$router->run();
