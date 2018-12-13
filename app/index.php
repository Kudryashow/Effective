<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require 'application/lib/Dev.php';

use application\core\Router;

spl_autoload_register(function ($class) {
//    echo $class;
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router;
$router->run();
//$action = new \application\controllers\AccountController();
//$path = 'application\\controllers\\\\'.ucfirst($this->params['controller']).'Controller.php';
