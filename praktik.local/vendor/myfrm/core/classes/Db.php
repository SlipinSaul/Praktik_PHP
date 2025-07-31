<?php

namespace myfrm;
use PDO;
use PDOException;
use PDOStatement;
final class Db
{
    private PDO $conn;
    private PDOStatement $stmt;
    private static $instance=null;


    private function __construct()
    {
    }

    public static function getInstance()
    {
        if(self::$instance===null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(array $db_config) {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";

        try {
            $this->conn = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
            return $this;
        } catch (PDOException $e) {
            echo "DB Error: " . $e->getMessage();
            die;
        }
    }

    public function query($query, $params = [])
    {
        try {
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->execute($params);

        }
        catch (PDOException $e) {
            return false;
        }
        return $this;
    }

    public function findAll(): array
    {
        return $this->stmt->fetchAll();
    }

    public function find()
    {
        return $this->stmt->fetch();
    }

    public function findOrFail()
    {
        $res=$this->find();
        if(!$res) {
            abort();
        }
        return $res;
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function getColumn()
    {
        return $this->stmt->fetchColumn();
    }

    public function getInsertId()
    {
        return $this->conn->lastInsertId();
    }

}