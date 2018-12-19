<?php

require 'vendor/autoload.php';
use application\core\Router;

session_start();
$router = new Router;
$router->run();
