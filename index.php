<?php
include 'includes/autoloader.php';

(new EnvReader(__DIR__ . '/.env'))->load();

$database = new db(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new sql($db);

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '':
    case '/' :
        require __DIR__ . '/webpage/view/index.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/webpage/404.php';
        break;
}