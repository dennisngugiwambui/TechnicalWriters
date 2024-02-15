@extends('Admin.app')

@section('content')


    <!-- Add this to your Blade layout or HTML file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        .orders {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .orders-title {
            font-size: 24px;
            margin: 0;
        }

        .orders-info {
            color: #6c757d;
            margin: 0;
        }

        .orders-filters {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .orders-filters-list {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .orders-filters-item {
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            margin-right: 10px;
            background-color: #fff;
            color: #495057;
        }

        .orders-filters-item.is-active {
            background-color: #007bff;
            color: #fff;
        }

        .orders-filters-select {
            margin-left: auto;
            margin-right: 10px;
        }

        .orders-filters-select-input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .orders-table {
            overflow: auto;
        }

        .orders-table-content {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .orders-table-header {
            padding: 15px;
            text-align: left;
            background-color: #063045;
            color: #fff;
            font-weight: bold;
        }

        .orders-table-data {
            padding: 15px;
            text-align: left;
            background-color: #fff;
            color: #000;
            font-size: 14px; /* Set font size */
            position: relative; /* Add position relative */
        }
        .orders-table-data::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px; /* Adjust height for the shadow size */
            background: rgba(0, 0, 0, 0.1); /* Adjust shadow color and opacity */
        }

        tbody tr:not(:last-child) {
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        orders-table-data-revision {
            font-size: 14px;
            font-weight: normal;
            font-size: 12px;
        }

        .orders-table-data-order-id {
            font-size: 18px; /* Adjust font size for Order ID */
            font-weight: normal;
            font-size: 12px;
        }
        .orders-info {
            background-color: #640604; /* Set background color */
            color: #fff; /* Set text color */
            padding: 10px; /* Add padding for better spacing */
            border-radius: 5px; /* Add border radius for rounded corners */
            display: inline-block; /* Ensure the background color wraps around the text */
            margin-top: 10px; /* Add margin for better spacing */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add box shadow for depth */
        }

    </style>

    <section class="orders">
        <div class="orders-header">
            <h2 class="orders-title">PAY WRITERS</h2>
        </div>
        <div class="orders-filters">



        </div>

        <div class="orders-table">
            <table class="orders-table-content">
                <thead>
                <tr>
                    <th class="orders-table-header">WRITER</th>
                    <th class="orders-table-header">ORDERS</th>
                    <th class="orders-table-header">TOTAL</th>
                    <th class="orders-table-header">DATE</th>
                    <th class="orders-table-header">COMMENT</th>
                    <th class="orders-table-header">ACTION</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="orders-table-data">
                        <span class="orders-table-data-revision"></span>
                        <br>
                        <span class="orders-table-data-order-id"></span>
                    </td>
                    <td class="orders-table-data"></td>
                    <td class="orders-table-data"></td>
                    <td class="orders-table-data">-</td>
                    <td class="orders-table-data"></td>
                    <td class="orders-table-data">
                        <i class="fa fa-edit fa-lg" style="color: blue; cursor: pointer;" onclick="window.location.href='/order';"></i>
                        <i class="fa fa-trash fa-lg" style="color: red; cursor: pointer;" onclick="deleteOrder('Order#')"></i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <script>
            function editOrder(orderId) {
                // Implement edit logic here
                console.log('Edit Order:', orderId);
            }

            function deleteOrder(orderId) {
                // Implement delete logic here
                console.log('Delete Order:', orderId);
            }
        </script>

    </section>



    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
    </button>


    <!-- Modal -->
    <div class="modal fade modal-dialog modal-dialog-centered" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Payment Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3 row">
                            <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="inputDate">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputWriterID" class="col-sm-2 col-form-label">WriterID</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputWriterID">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputComments" class="col-sm-2 col-form-label">Comments</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputComments">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Accept</button>
                        </div>
                    </form>

                    <script>
                        // Function to get the current date and time in the required format
                        function getCurrentDateTime() {
                            var now = new Date();
                            var year = now.getFullYear();
                            var month = ('0' + (now.getMonth() + 1)).slice(-2);
                            var day = ('0' + now.getDate()).slice(-2);
                            var hours = ('0' + now.getHours()).slice(-2);
                            var minutes = ('0' + now.getMinutes()).slice(-2);

                            return `${year}-${month}-${day}T${hours}:${minutes}`;
                        }

                        // Set the current date and time for the datetime-local input
                        document.getElementById('inputDate').value = getCurrentDateTime();
                    </script>

                </div>
            </div>
        </div>
    </div>

@endsection
