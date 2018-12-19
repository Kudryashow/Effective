<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.18
 * Time: 16:34
 */

namespace application\services;


class ConfigService
{
    private $_config = [];

    public function __construct()
    {
        $files = ['db', 'routes'];

        foreach ($files as $name) {
            $this->_config[$name] = $this->setConfig($name);
        }
    }

    private function setConfig($name)
    {
        $arr = require __DIR__ . '/../config/' . $name . '.php';
        return $arr;
    }

    public function getConfig($name)
    {
        return $this->_config[$name];
    }
}