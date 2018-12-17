<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.12.18
 * Time: 13:56
 */
namespace application\lib;
class Db
{
    protected $db;
    public function __construct()
    {
        $config = require 'application/config/db.php';
        $this->db = new \PDO('mysql:host='.$config['host'].';name='.$config['name'].'',$config['user'], $config['password']);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(':'.$key, $value);
            }
        }
        $stmt->execute();

        return $stmt;
    }

    public function row($sql, $params = [])
    {

        $result = $this->query($sql, $params);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}