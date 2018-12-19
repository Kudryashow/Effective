<?php

namespace application\lib;

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Dev
{
    static function debug($str)
    {
        echo '<pre>';
        var_dump($str);
        echo '</pre>';
        exit;
    }
}