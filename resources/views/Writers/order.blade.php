@extends('Writers.app')

@section('content')

    <style>
        .orders {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .orders-info {
            color: #6c757d;
            margin: 0;
            flex: 1;
        }

        .order-details {
            flex: 1;
            padding-left: 20px;
        }

        .order-details h3 {
            margin-top: 0;
        }

        .order-tabs {
            color: #222;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            flex: 1;
        }

        .order-tabs ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-tabs ul li {
            flex: 1;
            max-width: calc(25% - 10px);
        }

        .order-tabs ul li a {
            display: block;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            color: #1e0505;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }

        .order-tabs ul li a:hover {
            background-color: #ffcc00;
        }

        .order-tabs ul li.active a {
            background-color: #dc3545;
        }

        /* Add styles for tab contents */
        .tab-content {
            display: none;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .active-tab-content {
            display: block;
        }

        /* Media query for mobile view */
        @media only screen and (max-width: 600px) {
            .orders-header {
                flex-direction: column;
                align-items: flex-start;
            }

            p {
                font-size: 16px;
            }

            p span {
                font-size: 18px;
            }

            p .status {
                font-size: 14px;
            }

            .order-tabs ul li {
                max-width: 100%;
            }

            .tab-content {
                padding: 10px;
            }
        }
    </style>

    <script>
        function openTab(event, tabName) {
            var i, tabContents, tabLinks;
            tabContents = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
            }
            tabLinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tabLinks.length; i++) {
                tabLinks[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.classList.add("active");
        }
    </script>

    <section class="orders">
        <div class="orders-header">
            <div class="orders-info">
                <p><span>Order</span> #549829806 <span class="status">Canceled</span></p>
                <p><strong>ksh.8000 </strong> - New customer - 12:37 AM</p>
            </div>
            <div class="order-details">
                <h3>Task Details</h3>
                <p><strong>Task size:</strong> Extra small</p>
                <p><strong>Type of service:</strong> Programming</p>
                <p><strong>Discipline:</strong> Web programming</p>
                <p><strong>Programming language:</strong> JavaScript</p>
                <p><strong>Paper instructions:</strong></p>
                <p>Maize is a versatile crop that can grow in different varieties of soil, water, and climatic conditions. The crop has a wide range of tolerance to temperature conditions but grows well in warm regions where moisture is sufficient. The crop flourishes in regions with rainfall ranging from 1200mm to 2500mm but can adapt to regions receiving rainfall of up to 400 mm. The crop requires warm temperatures of between 15°C and 30 °C and thrives in a range of zones with altitudes ranging from 100 m to 2900 m ASL, depending on the variety.</p>
                <p>The crop is sensitive to moisture stress around tasseling time and during cob formation. Growth is favorable under a pH ranging from 5-8 with 5.5-7 being optimal because it is sensitive to salinity.</p>
            </div>
        </div>
        <div class="orders-filters">
            <!-- Add your filters here -->
        </div>
        <div class="order-tabs">
            <ul>
                <li><a href="#" class="tablinks active" onclick="
@endsection
