<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.12.18
 * Time: 16:52
 */

namespace application\core;
/**
 * Class Controller
 * @package application\core
 */
abstract class Controller
{

    public $route;
    public $view;
    public $model;
    public $acl;

    /**
     * Controller constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        if (!$this->checkAcl()) {
            View::errorCode(502);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function loadModel($name)
    {
        $path = 'application\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    /**
     * @return bool
     */
    public function checkAcl()
    {
        $this->acl = include 'application/acl/'.$this->route['controller'].'.php';
        if ($this->isAcl('all')) {
            return true;
        } elseif (isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')) {
            return true;
        } elseif (!isset($_SESSION['authorize']['id']) && $this->isAcl('guest')) {
            return true;
        } elseif (isset($_SESSION['admin']) && $this->isAcl('admin')) {
            return true;
        }
        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}