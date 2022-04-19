<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new Sql($db);

if (isset($_POST['id']) && $_POST['id'] != 0) {
    $result = $sqlQuery->DeleteReservation($_POST['id']);
}