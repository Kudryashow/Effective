<?php

namespace application\core;

//use application\services\ConfigService;

class Router
{

    protected $_routes = [];
    protected $_params = [];

    function __construct($routes)
    {
//        $config = new ConfigService;
//        $arr = $config->getConfig('routes');
        foreach ($routes as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function add($route, $direction)
    {
        $route = '#^' . $route . '$#';
        $this->_routes[$route] = $direction;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->_routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->_params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match()) {
            $root = 'application\controllers\\';
            $name = ucfirst($this->_params['controller']);
            $postfix = 'Controller';

            $path = $root . $name . $postfix;

            if (class_exists($path)) {
                $action = $this->_params['action'] . 'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->_params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}