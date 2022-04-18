<?php
require "../includes/autoloader.php";

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db);

$result = $sqlQuery->getAllTables();

$json = [];


foreach ($result as $table) {
    array_push($json, '<tr>
<td class="first:pl-0 pl-2 mt-2 border-gray-500">'.$table["id"].'</td>
<td class="first:pl-0 pl-2 mt-2 border-gray-500">'.$table["stoelen"].'</td>
<td class="text-blue-500"><button onclick="editTableModal('.$table['id'].')" type="button" class="btnEdit">Edit</button></td>
<td class="pl-4 text-red-500"><button onclick="deleteTable('.$table['id'].')" type="button" class="btnDelete">Delete</button></td>
</tr>');
}

echo json_encode($json);
