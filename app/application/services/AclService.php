<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.18
 * Time: 18:20
 */

namespace application\services;


class AclService
{
    private $_config = [];

    public function __construct()
    {
        $files = ['account', 'main'];

        foreach ($files as $name) {
            $this->_config[$name] = $this->setConfig($name);
        }
    }

    private function setConfig($name)
    {
        $arr = include 'application/acl/'.$name.'.php';
        return $arr;
    }

    public function getConfig($name)
    {
        return $this->_config[$name];
    }

}