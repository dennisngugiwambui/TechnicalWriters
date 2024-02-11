@extends('Admin.app')

@section('content')

    <style>
        .img-account-profile {
            height: 10rem;
        }
        .rounded-circle {
            border-radius: 50% !important;
        }
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }
        .card .card-header {
            font-weight: 500;
        }
        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }
        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }
        .form-control, .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }
        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }
        .joined-since-badge {
            display: inline-block;
            padding: 8px 12px;
            color: #c50f0f;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
        }
        .heading {
            font-size: 25px;
            margin-right: 25px;
        }

        .fa {
            font-size: 25px;
        }

        .checked {
            color: orange;
        }

        /* Three column layout */
        .side {
            float: left;
            width: 15%;
            margin-top: 10px;
        }

        .middle {
            float: left;
            width: 70%;
            margin-top: 10px;
        }

        /* Place text to the right */
        .right {
            text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* The bar container */
        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
        }

        /* Individual bars */
        .bar-5 {width: 60%; height: 18px; background-color: #04AA6D;}
        .bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
        .bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
        .bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
        .bar-1 {width: 15%; height: 18px; background-color: #f44336;}

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

        /* Responsive layout - make the columns stack on top of each other instead of next to each other */
        @media (max-width: 400px) {
            .side, .middle {
                width: 100%;
            }
            /* Hide the right column on small screens */
            .right {
                display: none;
            }
        }

    </style>


    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="#">Profile</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">Welcome Admin {{auth()->user()->name}}</div>

                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Below is your Admin profile</label>
                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Phone</label>
                                <input class="form-control" id="inputFirstName" type="text"  value="{{ auth()->user()->phone }}" readonly>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Email</label>
                                <input class="form-control" id="inputLastName" type="text"  value="{{auth()->user()->email}}" readonly>
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Account Level</label>
                                <input class="form-control" id="inputOrgName" type="text"  value="{{auth()->user()->usertype}}" readonly>
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Joined Since</label>
                                <div class="joined-since-badge" id="joinedSinceBadge"></div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        // Get the joined date from the input field
                                        var joinedDate = new Date("{{ auth()->user()->created_at }}");

                                        // Options for formatting the date
                                        var options = { year: 'numeric', month: 'long' };

                                        // Format the joined date
                                        var formattedDate = joinedDate.toLocaleDateString('en-US', options);

                                        // Update the joined since badge with the formatted date
                                        document.getElementById('joinedSinceBadge').innerText =  formattedDate;
                                    });
                                </script>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Completed Orders</label>
                                <input class="form-control" id="inputEmailAddress" type="email"  value="{{$finishedCount}}" readonly>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Row-->
    <section class="orders">
        <div class="orders-header">
            <h2 class="orders-title">All Users ( {{$AllUsers}})</h2>
        </div>
        <div class="orders-table">
            <div class="orders-search">
                <input type="text" class="form-control fancy-search" placeholder="Search Orders" id="myInput" onkeyup="myFunction()">
            </div>
            <table class="orders-table-content" id="myTable">
                <thead>
                <tr>
                    <th class="orders-table-header">ID</th>
                    <th class="orders-table-header">NAME</th>
                    <th class="orders-table-header">PHONE</th>
                    <th class="orders-table-header">EMAIL</th>
                    <th class="orders-table-header">PERMISSION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $onprogress)
                    <tr>
                        <td class="orders-table-data">{{$onprogress->id}}</td>
                        <td class="orders-table-data">{{$onprogress->name}}</td>
                        <td class="orders-table-data">{{$onprogress->phone}}</td>
                        <td class="orders-table-data">{{$onprogress->email}}</td>
                        <td class="orders-table-data">{{$onprogress->usertype}}</td>


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
