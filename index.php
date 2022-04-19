<?php
include 'includes/autoloader.php';

(new EnvReader(__DIR__ . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new sql($db);

$request = $_SERVER['REQUEST_URI'];
$url = explode('/', $request);
$getExtension = explode('?', $request);
switch ($url[1]) {
    case '':
    case '/' :
        require __DIR__ . '/webpage/view/index.php';
        break;
    case 'bestelling' . '?' . $getExtension[1]:
        require __DIR__ . '/webpage/view/order.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/webpage/404.php';
        break;
}