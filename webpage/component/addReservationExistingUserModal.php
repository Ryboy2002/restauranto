<?php
require ($_SERVER['DOCUMENT_ROOT'] ."../includes/autoloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$database = new db(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new sql($db);

$result = $sqlQuery->GetAllCustomers();
?>
<div id="addReservationExistingUserModal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Pas tafel aan</h3>
                        <div class="mt-2">
                            <form id="addReservationExistingUserForm">
                                <label for="reservation_table" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tafel</label>
                                <input type="number" id="reservation_table" name="reservation_table" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <label for="customer_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Klant ID</label>
                                <select id="customer_id" name="customer_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <?php
                                foreach ($result as $customer)
                                {
                                    echo '<option value="'.$customer["id"].'">'.$customer["id"].' | '.$customer["name"].'</option>';
                                }
                                ?>
                                </select>
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Datum</label>
                                <input type="date" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tijd</label>
                                <input type="time" id="time" name="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Aantal personen</label>
                                <input type="number" id="amount" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button form="addReservationExistingUserForm" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Opslaan</button>
                <button onclick="$('#addReservationExistingUserModal').addClass('hidden')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
            </div>
        </div>
    </div>
</div>