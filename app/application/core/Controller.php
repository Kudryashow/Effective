<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.12.18
 * Time: 16:52
 */

namespace application\core;
use application\services\AclService;

abstract class Controller
{

    public $route;
    public $view;
//    public $model;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
//        if (!$this->checkAcl()) {
//            View::errorCode(502);
//        }
        $this->view = new View($route);
//        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'application\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
        return new \Exception($path.' not exist');
    }

    public function checkAcl()
    {
        $isUser = isset($_SESSION['authorize']['id']);
        $isAdmin = isset($_SESSION['admin']);

        $acl = new AclService();
        $this->acl = $acl->getConfig($this->route['controller']);

        if ($this->hasAccess('all')) {
            return true;
        } elseif ($isUser && $this->hasAccess('authorize')) {
            return true;
        } elseif (!$isUser && $this->hasAccess('guest')) {
            return true;
        } elseif ($isAdmin && $this->hasAccess('admin')) {
            return true;
        }
        return false;
    }

    public function hasAccess($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}