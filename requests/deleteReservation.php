<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

$database = new db();
$db = $database->getConnection();
$sqlQuery = new Sql($db);

if (isset($_POST['id']) && $_POST['id'] != 0) {
    $result = $sqlQuery->DeleteReservation($_POST['id']);
}