<?php
require "../includes/autoloader.php";

$database = new db();
$db = $database->getConnection();
$sqlQuery = new sql($db);

$result = $sqlQuery->GetAllReservations();
$json = [];

foreach ($result as $table) {
    array_push($json, '
            <tr class="border-b">
              <td data-id="'.$table['id'].'" class="reservation_id" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                '.$table['id'].'
              </td>
              <td data-id="'.$table['id'].'" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['reservation_table'].'
              </td>
              <td data-id="'.$table['id'].'" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['customer_id'].'
              </td>
              <td data-id="'.$table['id'].'" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['date'].'
              </td>
              <td data-id="'.$table['id'].'" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['time'].'
              </td>
              <td data-id="'.$table['id'].'" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['amount'].'
              </td>
                <td data-id="'.$table['id'].'" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                 '.$table['used'].'
              </td>
              <td data-id="'.$table['id'].'" class="text-sm font-light px-6 py-4 whitespace-nowrap text-blue-500"><button onclick="editTableModal('.$table['id'].')" type="button" class="btnEdit">Edit</button></td>
              <td data-id="'.$table['id'].'" class="text-sm font-light px-6 py-4 whitespace-nowrap pl-4 text-red-500"><button onclick="deleteReservation('.$table['id'].')" type="button" class="btnDelete">Delete</button></td>
            </tr>
          ');
}

echo json_encode($json);
