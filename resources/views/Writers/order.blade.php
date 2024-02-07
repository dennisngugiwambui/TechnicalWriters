@extends('Writers.app')

@section('content')

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

        h2 {
            display: flex;
            align-items: center;
            margin: 0;
        }

        h2 span.status {
            margin-left: 10px;
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
        }

        .orders-info {
            color: #6c757d;
            margin: 0;
        }
    </style>

    <section class="orders">
        <div class="orders-header">
            <p><span>Order</span> #549829806 <span class="status">Canceled</span></p>
            <p><strong>ksh.8000 </strong> - New customer - 12:37 AM</p>
        </div>
        <div class="orders-filters">
            <!-- Add your filters here -->
        </div>
    </section>

@endsection
