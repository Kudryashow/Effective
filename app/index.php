<?php
require 'vendor/autoload.php';
require 'application/lib/Dev.php';

use application\core\Router;

session_start();
phpinfo();
$router = new Router;
$router->run();
