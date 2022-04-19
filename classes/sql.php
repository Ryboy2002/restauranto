<?php

class sql
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function GetAllReservations()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `reservation`");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function GetAllOrdersFromReservation($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `order` INNER JOIN reservation ON `order`.reservation_id = reservation.id INNER JOIN `menu_item` ON `order`.`menu_item_code` = menu_item.menu_item_code WHERE `reservation_id` = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function GetAllCustomers()
    {
        $stmt = $this->conn->prepare("SELECT * FROM `customer`");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function InsertToCustomer($name, $number)
    {
        $stmt = $this->conn->prepare("INSERT INTO `customer` (`name`, `phone_number`) VALUES (?,?)");
        $stmt->bind_param("si", $name, $number);
        $stmt->execute();
        return $stmt;
    }

    public function InsertToReservation($reservation_table, $customer_id, $date, $time, $amount)
    {
        $stmt = $this->conn->prepare("INSERT INTO `reservation` (`reservation_table`, `customer_id`, `date`,  `time`, `amount`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("iissi", $reservation_table, $customer_id, $date, $time, $amount);
        $stmt->execute();
        return $stmt;
    }

    public function EditReservation($reservation_table, $customer_id, $date, $time, $amount, $used, $id)
    {
        $stmt = $this->conn->prepare("UPDATE `reservation` SET `reservation_table`= ?, `customer_id`= ?, `date`= ?, `time`= ?, `amount`= ? ,`used`= ? WHERE id = ?");
        $stmt->bind_param("iissiii", $reservation_table, $customer_id, $date, $time, $amount, $used, $id);
        $stmt->execute();
        return $stmt;
    }

    public function GetUserByName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `customer` WHERE `name` = ? ORDER BY `date_time` DESC LIMIT 1");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function DeleteReservation($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `reservation` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function GetReservation($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `reservation` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}