<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Homepagina</title>
</head>
<body class="bg-gray-500">
<div class="flex flex-row">
    <div class="w-1/4 bg-orange-500">
        <h1 class="text-3xl text-gray-300 font-bold text-center">
            Hello world!
        </h1>
    </div>

    <div class="w-3/4 mr-8 flex flex-col">
        <div class="mx-auto">
            <button onclick="makeReservationNewCustomer()" class="bg-blue-500 text-white py-2 px-2 rounded-lg">Nieuwe reservatie nieuwe klant</button>
            <button onclick="makeReservationExistingCustomer()" class="bg-blue-500 text-white py-2 px-2 rounded-lg">Nieuwe reservatie bestaande klant</button>
        </div>


        <div class="mx-auto w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Tafel
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Klant ID
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Datum
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Tijd
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Personen
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Gebruikt
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="container-reservations">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tailwind Modal -->
<div id="container-modal">
<?php include_once 'webpage/component/addReservationExistingUserModal.php'?>
<?php include_once 'webpage/component/addReservationModal.php'?>
<?php include_once 'webpage/component/addUserModal.php'?>
<?php include_once 'webpage/component/editTableModal.php'?>
</div>
<!-- End Modal-->




<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {
        var request;

        $("#addUserForm").submit(function (event) {
            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("input, select, button, textarea");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            var name = $('#customer_name').val();
            request = $.ajax({
                url: "requests/addUser.php",
                type: "post",
                data: serializedData,
            });

            request.done(function (response, textStatus, jqXHR) {
                InjectUserID(name);
                $('#addUserModal').addClass('hidden');
                $('#addReservationModal').removeClass('hidden');
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error(
                    "The following error occured: "+
                    textStatus, errorThrown
                )
            });

            request.always(function () {
                $inputs.prop("disabled", false);
            });
        });

        $("#addReservationForm").submit(function (event) {
            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("input, select, button, textarea");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            request = $.ajax({
                url: "requests/addReservation.php",
                type: "post",
                data: serializedData,
            });

            request.done(function (response, textStatus, jqXHR) {
                buildTable();
                $('#addReservationModal').addClass('hidden');
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error(
                    "The following error occured: "+
                    textStatus, errorThrown
                )
            });

            request.always(function () {
                $inputs.prop("disabled", false);
            });
        });

        $("#addReservationExistingUserForm").submit(function (event) {
            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("input, select, button, textarea");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            request = $.ajax({
                url: "requests/addReservationExistingUser.php",
                type: "post",
                data: serializedData,
            });

            request.done(function (response, textStatus, jqXHR) {
                buildTable();
                $('#addReservationExistingUserModal').addClass('hidden');
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error(
                    "The following error occured: "+
                    textStatus, errorThrown
                )
            });

            request.always(function () {
                $inputs.prop("disabled", false);
            });
        });

        $("#editReservationExistingUserForm").submit(function (event) {
            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("input, select, button, textarea");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            request = $.ajax({
                url: "requests/editReservation.php",
                type: "post",
                data: serializedData,
            });

            request.done(function (response, textStatus, jqXHR) {
                buildTable();
                $('#editReservationModal').addClass('hidden');
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error(
                    "The following error occured: "+
                    textStatus, errorThrown
                )
            });

            request.always(function () {
                $inputs.prop("disabled", false);
            });
        });

        buildTable();
    });

    function makeReservationNewCustomer() {
        $('#addUserModal').removeClass('hidden');
    }

    function makeReservationExistingCustomer() {
        $('#addReservationExistingUserModal').removeClass('hidden');
    }

    function deleteReservation(id)
    {
        var request = $.ajax({
            url: "requests/deleteReservation.php",
            type: "post",
            data: {id:id}
        });

        request.done(function (response, textStatus, jqXHR) {
            buildTable();
        });
    }

    function InjectUserID(name) {
        var request = $.ajax({
            url: "requests/getUser.php",
            type: "get",
            data: {name: name}
        });

        request.done(function (response, textStatus, jqXHR) {
            var result = JSON.parse(response);
            $('#customer_id_new').attr('value', result[0]);
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error(
                "The following error occured: "+
                textStatus, errorThrown
            )
        });
    }

    function editTableModal(id) {
        buildCustomerSelectOptions();

        var request = $.ajax({
            url: "requests/editTableModal.php",
            type: "get",
            data: {id: id}
        });

        request.done(function (response, textStatus, jqXHR) {
            var result = JSON.parse(response);
            $('#reservation_id_edit').val(result[0])
            $('#reservation_table_edit').val(result[1])
            $('#customer_id_edit').val(result[2])
            $('#date_edit').val(result[3])
            $('#time_edit').val(result[4])
            $('#amount_edit').val(result[5])
            $('#used_edit').val(result[6])
            $('#editReservationModal').removeClass('hidden');
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error(
                "The following error occured: "+
                textStatus, errorThrown
            )
        });

    }

    function deleteTable(id) {
        var request = $.ajax({
            url: "requests/deleteTable.php",
            type: "post",
            data: {id:id}
        });

        request.done(function (response, textStatus, jqXHR) {
            buildTable();
        });
    }

    function buildCustomerSelectOptions()
    {
        var request = $.ajax({
            url: "requests/buildCustomerSelectOptions.php",
            type: "get",
        });

        request.done(function (response, textStatus, jqXHR) {
            var result = JSON.parse(response);
            $("#customer_id_edit").html("");
            result.forEach(element => $("#customer_id_edit").append(element));
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error(
                "The following error occured: "+
                textStatus, errorThrown
            )
        });
    }


    function buildTable() {
         var request = $.ajax({
            url: "requests/buildTable.php",
            type: "get",
        });

        request.done(function (response, textStatus, jqXHR) {
            var result = JSON.parse(response);
            $("#container-reservations").html("");
            result.forEach(element => $("#container-reservations").append(element));
            $('#container-reservations tr').click(function(event) {
                window.location.href = "/bestelling?id=" + this.cells[0].innerText;
            });
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error(
                "The following error occured: "+
                textStatus, errorThrown
            )
        });
    }
</script>
</body>
</html>