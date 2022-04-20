<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

$database = new db();
$db = $database->getConnection();
$sqlQuery = new Sql($db);

if (isset($_POST['customer_id'])) {
    $result = $sqlQuery->InsertToReservation($_POST['reservation_table'], $_POST['customer_id'],$_POST['date'],$_POST['time'],$_POST['amount']);
}
