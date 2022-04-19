<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>

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
                                        Reservatie ID
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Menu Item Code
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aantal besteld
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="container-order">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {
        BuildOrderTable();
    });

    function BuildOrderTable() {
        var request = $.ajax({
            url: "requests/buildOrderTable.php",
            type: "get",
            data: {id: <?=$getExtension[1]?>}
        });

        request.done(function (response, textStatus, jqXHR) {
            var result = JSON.parse(response);
            $("#container-order").html("");
            result.forEach(element => $("#container-order").append(element));
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
