<?php namespace MariuszAnuszkiewicz\classes;

use MariuszAnuszkiewicz\Config\Config;

class DB
{
    const CONNECT_FAILED = "Failed to connect to Database";
    private static $instance;
    private $pdo,
            $query,
            $error = false,
            $results,
            $count = 0;

    public function __construct() {

        $username = Config::get('db.user');
        $password = Config::get('db.password');
        $dsn = 'mysql:dbname='. Config::get('db.db_name') . ';host=' . Config::get('db.host') .'';

        try{
            $this->pdo = new \PDO($dsn, $username, $password);
        }catch(\PDOException $e) {
            echo self::CONNECT_FAILED;
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function query($sql, $params = array()) {

        if (!empty($params)) {
            $this->error = false;
            if ($this->query = $this->pdo->prepare($sql)) {
                $x = 1;
                if (count($params)) {
                    if (is_array($params) || is_object($params) || is_string($params) || is_numeric($params)) {
                        foreach ($params as $param) {
                            $this->query->bindValue($x, $param);
                            $x++;
                        }
                    }
                }

                if ($this->query->execute()) {
                    $this->results = $this->query->fetchAll(\PDO::FETCH_ASSOC);
                    $this->count = $this->query->rowCount();
                } else {
                    $this->error = true;
                }
            }
            return $this;

        } else {
               $this->error = false;
            if ($this->query = $this->pdo->prepare($sql)) {
                if ($this->query->execute()) {
                   $this->results = $this->query->fetchAll(\PDO::FETCH_ASSOC);
                   $this->count = $this->query->rowCount();
                } else {
                   $this->error = true;
                }
            }
            return $this;
        }
    }

    public function getExecute() {
        return $this->query->execute();
    }

    public function countRow() {
        return $this->count;
    }

    public function results() {
        return $this->results;
    }

    public function error() {
        return $this->error;
    }
}