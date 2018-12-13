<?php

namespace application\core;

use mysql_xdevapi\Exception;

class Router
{

    protected $routes = [];
    protected $params = [];

    function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function add($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match()) {
            var_dump($this);
//            application\controllers\MainController
            $path = 'application\\controllers\\\\'.ucfirst($this->params['controller']).'Controller.php';
            echo $path;

            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path();
                    $controller->$action();
                } else {
                    echo 'ERROR: action '.$action.' not found !';
                }
            } else {
                echo 'ERROR: controller '.$path.' not found !';
            }
        } else {
            echo 'Not found <b>404</b>';
        }
    }
}