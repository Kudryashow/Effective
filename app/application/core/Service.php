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

    public function __construct()
    {
        $this->setRootDirectory(__DIR__ . '/../config');
        $files = Dev::extractFiles($this->_path);
        foreach ($files as $file) {
            $name = preg_replace("/.php$/", "", $file);
            $this->_config[$name] = $this->setConfig($file);
        }
    }
    private function setConfig($name)
    {
        $arr = require __DIR__ . '/../config/' . $name;
        return $arr;
    }
    private function setRootDirectory($path)
    {
        $this->_path = $path;
    }
    abstract public function getConfig($config);
}