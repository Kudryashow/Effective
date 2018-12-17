<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * @param $str debug tgt
 */
function debug($str) {
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}