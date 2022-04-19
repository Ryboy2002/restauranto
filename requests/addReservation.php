<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new Sql($db);

if (isset($_POST['customer_id_new'])) {
    $result = $sqlQuery->InsertToReservation($_POST['reservation_table_new'], $_POST['customer_id_new'],$_POST['date_new'],$_POST['time_new'],$_POST['amount_new']);
}
