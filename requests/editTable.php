<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db);

if (isset($_POST['id']) && $_POST['id'] != 0) {
    $result = $sqlQuery->updateTable($_POST['id'], $_POST['stoelen']);
    echo $_POST['id']. $_POST['stoelen'];
} else {
    echo $_POST['id']. $_POST['stoelen'];
}