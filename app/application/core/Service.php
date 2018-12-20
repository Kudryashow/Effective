<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.12.18
 * Time: 13:31
 */

namespace application\core;

use application\lib\Dev;

abstract class Service
{
    private $_path;
    private $_config = [];

    public function __construct($path)
    {
        $this->setRootDirectory($path);
        $files = Dev::extractFiles($this->_path);
        foreach ($files as $file) {
            if (gettype($file) !== 'array') {
                $name = preg_replace("/.php$/", "", $file);
                $this->_config[$name] =
                    $this->setConfig($this->_path.DIRECTORY_SEPARATOR.$file);
            }
        }
    }

    function setFilepath($files, $prefix = '')
    {
        $routes = [];
        foreach ($files as $key => $file) {
            if (gettype($file) === 'array') {

                $routes[$key] = $this->
                setFilepath($file, $key);
            } else {
                if ($prefix) {
                    $routes[] = $prefix . DIRECTORY_SEPARATOR . $file;
                } else {
                    $routes[] = $file;
                }
            }
        }
        return $routes;
    }

    private function setRootDirectory($path)
    {
        $this->_path = __DIR__.'/../'.$path;
    }

    private function setConfig($path)
    {
        $arr = require $path;
        return $arr;
    }

    public function getConfig($config){
        return $this->_config[$config];
    }
}