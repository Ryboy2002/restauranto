<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

$database = new db(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db);

$result = $sqlQuery->GetReservation($_GET['id']);

$json = [];


foreach ($result as $table) {
    array_push($json, $table['id']);
    array_push($json, $table['reservation_table']);
    array_push($json, $table['customer_id']);
    array_push($json, $table['date']);
    array_push($json, $table['time']);
    array_push($json, $table['amount']);
    array_push($json, $table['used']);
}

echo json_encode($json);