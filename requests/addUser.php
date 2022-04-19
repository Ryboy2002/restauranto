<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new Sql($db);

if (isset($_POST['customer_name'])) {
    $result = $sqlQuery->InsertToCustomer($_POST['customer_name'], $_POST['phone_number']);
}
