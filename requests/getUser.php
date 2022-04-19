<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new Sql($db);

$result = $sqlQuery->GetUserByName($_GET['name']);
$json = [];


foreach ($result as $table) {
    array_push($json, $table['id']);
}

echo json_encode($json);