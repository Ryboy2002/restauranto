<?php

class db
{
    private $host;
    private $user;
    private $password;
    private $dbName;
    public $conn;

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->dbName = "restauranto";
    }

    public function  getConnection() {
        $this->conn = null;


        // Create connection
        $this->conn = new mysqli($this->host, $this->user, $this->password,$this->dbName);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}