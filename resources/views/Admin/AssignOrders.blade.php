@extends('Admin.app');

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
                <h2 class="orders-title">Available Bids</h2>
            </div>
            <div class="orders-table">
                @foreach($bidsGroupedByOrderId as $item)
                    <p>Bids for order {{$item['order_id']}}</p>
                    <table class="orders-table-content">
                        <thead>
                        <tr>
                            <th class="orders-table-header">ORDER ID</th>
                            <th class="orders-table-header">WRITER ID</th>
                            <th class="orders-table-header">UCOMPLETED ORDERS</th>
                            <th class="orders-table-header">PHONE</th>
                            <th class="orders-table-header">DEADLINE</th>
                            <th class="orders-table-header">ASSIGNMENT TYPE</th>
                            <th class="orders-table-header">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item['bids'] as $bid)
                            <tr>
                                <td class="orders-table-data">{{$bid->first()->OrderId}}</td>
                                <td class="orders-table-data">{{$bid->first()->writer_id}}</td>
                                <td class="orders-table-data">{{$bid->first()->ucompleted_orders}}</td>
                                <td class="orders-table-data">{{$bid->first()->writer_phone}}</td>
                                <td class="orders-table-data">{{$bid->first()->deadline}}</td>
                                <td class="orders-table-data">{{$bid->first()->assignmentType}}</td>
                                <td class="orders-table-data">
                                    <i class="fa fa-edit fa-lg" style="color: blue; cursor: pointer;" onclick="window.location.href='/order/{{$bid->first()->OrderId}}';">Assign</i>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>

        </section>



@endsection
