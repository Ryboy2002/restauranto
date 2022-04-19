<?php
require "../includes/autoloader.php";

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db();
$db = $database->getConnection();
$sqlQuery = new sql($db);

$result = $sqlQuery->GetAllOrdersFromReservation($_GET['id']);
$json = [];
foreach ($result as $table) {
    array_push($json, '
            <tr class="border-b">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                '.$table['id'].'
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['reservation_id'].'
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['menu_item_code'].' |  '.$table['menu_item'].'
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['amount'].'
              </td>
            </tr>
          ');
}

echo json_encode($json);
