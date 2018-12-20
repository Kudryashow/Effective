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

    static function extractFiles($dir)
    {
        $result = array();

        $currentDir = scandir($dir);
        foreach ($currentDir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] =
                        self::extractFiles($dir.DIRECTORY_SEPARATOR.$value);
                } else {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }
}