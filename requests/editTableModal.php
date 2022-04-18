<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db);

$result = $sqlQuery->getTable($_GET['id']);

$json = [];


foreach ($result as $table) {
    array_push($json, $table['id']);
    array_push($json, $table['stoelen']);
}

echo json_encode($json);