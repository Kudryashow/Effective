<?php

namespace application\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = [])
    {
        $path = 'application/views/'.$this->path.'.php';
        extract($vars);
        if (file_exists($path)) {
            ob_start();
            include $path;
            $content = ob_get_clean();
            include 'application/views/layouts/'.$this->layout.'.php';
        }

    }

    public function redirect($url)
    {
        header('location: '.$url);
        exit();
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        $root = __DIR__.'/../application/views/errors/';
        $resolve = '.php';
        $path = $root.$code.$resolve;

        if (file_exists($path)) {
            include $path;
        } else {
            exit('Error:: '.$path.' is empty');
        }
        exit();
    }

    public function message($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }
}