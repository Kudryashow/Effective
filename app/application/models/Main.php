<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.12.18
 * Time: 18:33
 */

namespace application\models;
use application\core\Model;

class Main extends Model
{
    public function getNews()
    {
        $result = $this->db->row('SELECT title, text FROM mvc.news');
        return $result;
    }
}