<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.12.18
 * Time: 16:52
 */

namespace application\core;

abstract class Controller
{

    public $route;

    public function __construct($route)
    {
        $this->route = $route;
    }
}