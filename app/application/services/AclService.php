<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.18
 * Time: 18:20
 */

namespace application\services;

use application\core\Service;

class AclService extends Service
{
    private $_config = [];

    public function getConfig($name)
    {
        return $this->_config[$name];
    }

}