<?php
require "../includes/autoloader.php";

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new sql($db);

$result = $sqlQuery->GetAllCustomers();
$json = [];

foreach ($result as $customer) {
    array_push($json, '<option value="'.$customer["id"].'">'.$customer["id"].' | '.$customer["name"].'</option>');
}

echo json_encode($json);
