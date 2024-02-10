@extends('Admin.app')

@section('content')

    <!-- Add this to your Blade layout or HTML file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
            <h2 class="orders-title">Newly Added Orders (1)</h2>
        </div>
        <div class="orders-table">
            <table class="orders-table-content">
                <thead>
                <tr>
                    <th class="orders-table-header">ORDER ID</th>
                    <th class="orders-table-header">TOPIC TITLE</th>
                    <th class="orders-table-header">DISCIPLINE</th>
                    <th class="orders-table-header">PAGES</th>
                    <th class="orders-table-header">DEADLINE</th>
                    <th class="orders-table-header">CPP</th>
                    <th class="orders-table-header">COST</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order as $order)
                    <tr>
                        <td class="orders-table-data">
                            <span class="orders-table-data-revision">{{$order->assignmentType}}</span>
                            <br>
                            <span class="orders-table-data-order-id">Order#{{$order->OrderId}}</span>
                        </td>
                        <td class="orders-table-data">{{$order->topicTitle}}</td>
                        <td class="orders-table-data">{{$order->discipline}}</td>
                        <td class="orders-table-data">-</td>
                        <td class="orders-table-data">{{$order->deadline}}</td>
                        <td class="orders-table-data">{{$order->cpp}}</td>
                        <td class="orders-table-data">
                            <i class="fa fa-edit fa-lg" style="color: blue; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$order->id}}"></i>



                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('available', ['id'=>$order->id])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <p>By pressing this button you will have made this order available to the writer. Do you want to continue?</p>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>


    <!-- On progress Orders -->
    <section class="orders">
        <div class="orders-header">
            <h2 class="orders-title">All Orders In Progress( {{$current}})</h2>
        </div>
        <div class="orders-table">
            <div class="orders-search">
                <input type="text" class="form-control fancy-search" placeholder="Search Orders" id="myInput" onkeyup="myFunction()">
            </div>
            <table class="orders-table-content" id="myTable">
                <thead>
                <tr>
                    <th class="orders-table-header">ORDER ID</th>
                    <th class="orders-table-header">TOPIC TITLE</th>
                    <th class="orders-table-header">DISCIPLINE</th>
                    <th class="orders-table-header">PAGES</th>
                    <th class="orders-table-header">DEADLINE</th>
                    <th class="orders-table-header">CPP</th>
                    <th class="orders-table-header">COST</th>
                </tr>
                </thead>
                <tbody>
                @foreach($onprogress as $onprogress)
                    <tr>
                        <td class="orders-table-data">
                            <span class="orders-table-data-revision">{{$onprogress->assignmentType}}</span>
                            <br>
                            <span class="orders-table-data-order-id">Order#{{$onprogress->OrderId}}</span>
                        </td>
                        <td class="orders-table-data">{{$onprogress->topicTitle}}</td>
                        <td class="orders-table-data">{{$onprogress->discipline}}</td>
                        <td class="orders-table-data">-</td>
                        <td class="orders-table-data">{{$onprogress->deadline}}</td>
                        <td class="orders-table-data">{{$onprogress->cpp}}</td>
                        <td class="orders-table-data">
                            <i class="fa fa-edit fa-lg" style="color: blue; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$onprogress->id}}"></i>



                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_{{$onprogress->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('available', ['id'=>$onprogress->id])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <p>By pressing this button you will have made this order available to the writer. Do you want to continue?</p>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


@endsection
