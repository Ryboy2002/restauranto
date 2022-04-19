<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new Sql($db);

if (isset($_POST['reservation_id_edit'])) {
    $result = $sqlQuery->EditReservation($_POST['reservation_table_edit'], $_POST['customer_id_edit'],$_POST['date_edit'],$_POST['time_edit'],$_POST['amount_edit'],$_POST['used_edit'],$_POST['reservation_id_edit']);
} else {
    echo "Gefaald";
}
