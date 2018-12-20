<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.12.18
 * Time: 18:40
 */

namespace helpers;


class ArrayHelper
{
    public function expandArray($arr)
    {
        $a = $this->getUpperElements($arr);
        $b = $this->getDeeperElements($arr);
        return array_merge($a, $b);
    }

    public function getUpperElements($array)
    {
        $result = [];
        foreach ($array as $item) {
            if (gettype($item) !== 'array') {
                $result[] = $item;
            }
        }
        return $result;
    }

    public function getDeeperElements($array, $acc = [])
    {
        foreach ($array as $item) {
            if (gettype($item) === 'array') {
                return $this->getDeeperElements($item, $acc);
            } else {
                $acc[] = $item;
            }
        }
        return $acc;
    }
}