<?php

namespace application\core;
/**
 * Class Router
 * @package application\core
 */
class Router
{

    protected $routes = [];
    protected $params = [];

    /**
     * Router constructor.
     */
    function __construct()
    {
        $arr = include __DIR__.'/../config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
    }

    /**
     * @param $route
     * @param $direction
     */
    public function add($route, $direction)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $direction;
    }

    /**
     * @return bool
     */
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

    /**
     *
     */
    public function run()
    {
        if ($this->match()) {
            $root = 'application\controllers\\';
            $name = ucfirst($this->params['controller']);
            $postfix = 'Controller';
            
            $path = $root.$name.$postfix;
            
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
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