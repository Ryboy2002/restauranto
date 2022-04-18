<?php

class db
{
    private $host;
    private $user;
    private $password;
    private $dbName;
    public $conn;

    public function __construct($host, $user, $password, $dbName)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function  getConnection() {
        $this->conn = null;

        try {
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
            $this->conn = new PDO($dsn,$this->user, $this->password);
        } catch (PDOException $exception) {
            return array("error" => 1, "errormessage" => $exception->getMessage());
        }

        return $this->conn;
    }
}