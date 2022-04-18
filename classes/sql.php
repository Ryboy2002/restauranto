<?php

class sql
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllTables()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `tafels`");
        $stmt->execute();
        return $stmt;
    }

    public function getTable($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `tafels` WHERE `id` = ?");
        $stmt->execute([$id]);
        return $stmt;
    }

    public function insertToTables($stoelen)
    {
        $stmt = $this->conn->prepare("INSERT INTO `tafels` (`stoelen`) VALUES (?)");
        $stmt->execute([$stoelen]);
        return $stmt;
    }

    public function updateTable($id, $stoelen)
    {
        $stmt = $this->conn->prepare("UPDATE `tafels` SET `stoelen`= ? WHERE id = ?");
        $stmt->execute([$stoelen, $id]);
        return $stmt;
    }

    public function deleteFromTables($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `tafels` WHERE `id` = ?");
        $stmt->execute([$id]);
        return $stmt;
    }
}