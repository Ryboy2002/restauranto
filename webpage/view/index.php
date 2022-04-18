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
<div class="mx-auto w-1/4">
    <div>
        <h1 class="text-3xl text-gray-300 font-bold text-center">
            Hello world!
        </h1>
    </div>

    <div class="mx-auto mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <table class="table-auto mr-0 text-2xl">
            <thead>
            <tr>
                <th>ID</th>
                <th class="pl-2">Stoelen</th>
            </tr>
            </thead>
            <tbody id="container-stoelen" class="text-xl">
            </tbody>
        </table>
    </div>

    <div class="mx-auto mt-4 w-full">
        <form id="formAddTable">
            <div class="mb-6">
                <label for="stoelen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Aantal stoelen</label>
                <input type="number" id="stoelen" name="stoelen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <button value="Send" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
</div>

<!-- Tailwind Modal -->
<div id="container-modal">
<?php include_once 'webpage/component/editTableModal.php'?>
</div>
<!-- End Modal-->


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {


        var request;

        $("#editTableForm").submit(function (event) {
            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("input, select, button, textarea");

            var serializedData = $form.serialize();
            $inputs.prop("disabled", true);

            request = $.ajax({
                url: "requests/editTable.php",
                type: "post",
                data: serializedData,
            });

            request.done(function (response, textStatus, jqXHR) {
                buildTable();
                $('#editTableModal').addClass('hidden');
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
        })

        $("#formAddTable").submit(function (event){
            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("input, select, button, textarea");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);
            request = $.ajax({
                url: "requests/addTable.php",
                type: "post",
                data: serializedData
            });

            request.done(function (response, textStatus, jqXHR) {
                buildTable();
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

    function editTableModal(id) {
        var request = $.ajax({
            url: "requests/editTableModal.php",
            type: "get",
            data: {id: id}
        });

        request.done(function (response, textStatus, jqXHR) {
            var result = JSON.parse(response);
            $('#editStoelenID').val(result[0])
            $('#editStoelen').val(result[1])
            $('#editTableModal').removeClass('hidden');
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

    function buildTable() {
         var request = $.ajax({
            url: "requests/buildTable.php",
            type: "get",
        });

        request.done(function (response, textStatus, jqXHR) {
            var result = JSON.parse(response);
            $("#container-stoelen").html("");
            result.forEach(element => $("#container-stoelen").append(element));
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