<?php

namespace application\lib;
use application\services\ConfigService;
class Db
{
    protected $db;

    public function __construct()
    {
        $configuration = new ConfigService;
        $settings = $configuration->getConfig('db');
        $dsn = 'mysql:host='.$settings['host'].';name='.$settings['name'].'';
        $this->db = new \PDO($dsn, $settings['user'], $settings['password']);
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