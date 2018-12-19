<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.12.18
 * Time: 18:38
 */

namespace application\core;

use application\lib\Db;

/**
 * Class Model
 * @package application\core
 */
abstract class Model
{
    public $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new Db;
    }
}