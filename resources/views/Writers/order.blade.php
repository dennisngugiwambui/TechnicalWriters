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

        p {
            margin: 0;
            font-size: 18px;
            color: #343a40;
        }

        p span {
            font-weight: bold;
            font-size: 20px;
            color: #007bff;
            margin-right: 10px;
        }

        p .status {
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            font-size: 16px;
        }

        .orders-info {
            color: #6c757d;
            margin: 0;
        }

        .order-tabs {
            color: #222;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .order-tabs ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap; /* Allow tabs to wrap on smaller screens */
            gap: 10px; /* Add gap between tabs */
        }

        .order-tabs ul li {
            flex: 1;
            max-width: calc(13% - 10px); /* Show four tabs per row on desktop screens */
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
        }

        .active-tab-content {
            display: block;
        }
        .bidding-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Adjust the styles for the bid button */
        .buttone {
            padding: 10px 15px;
            font-size: 14px;
            text-align: center;
            cursor: pointer;
            outline: none;
            color: #fff;
            background-color: #04AA6D;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
            flex-shrink: 0; /* Prevent button from shrinking */
        }

        .buttone:hover {
            background-color: #3e8e41;
        }

        .buttone:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

        .tab-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Align items at the start of the flex container */
            margin-bottom: 20px;
        }


        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1; /* Each card takes up equal space */
            font-size: 12px;
        }

        .left_side,
        .right-side {
            flex: 1;
            transition: transform 0.3s ease; /* Add a smooth transition effect */
        }

        .left_side {
            border-right: 2px solid #ccc;
            margin-right: 10px; /* Add some space between the cards */
        }

        .right-side {
            margin-left: 10px; /* Add some space between the cards */
        }

        /* Styling the headings */
        h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        /* Styling the content */
        p {
            font-size: 14px;
            margin-bottom: 5px;
            color: #666;
        }
        #all-files {
            display: none; /* Initially hide the content */
        }

        .file-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .file-name {
            flex-grow: 1;
            font-weight: bold;
            margin-right: 10px;
        }

        .file-details {
            flex-shrink: 0;
            text-align: right;
            color: #6c757d;
        }
        .file-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .file-description {
            font-size: 12px;
            color: #6c757d;
            margin: 0;
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
                max-width: 100%; /* Show one tab per row on smaller screens */
            }
            .bidding-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .buttone {
                margin-top: 10px; /* Add some space between the button and the details on mobile */
            }
        }
    </style>

    <script>
        // Wait for the DOM content to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Hide all tab contents
            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
            }

            // Show the Instructions tab content and mark it as active
            document.getElementById("instructions").style.display = "block";
            var activeTabLink = document.querySelector(".tablinks.active");
            if (activeTabLink) {
                activeTabLink.classList.remove("active");
            }
            var instructionsTabLink = document.querySelector(".tablinks[href='#instructions']");
            if (instructionsTabLink) {
                instructionsTabLink.classList.add("active");
            }
        });

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
            <p><span>Order</span> #549829806 <span class="status">Canceled</span></p>
            <p><strong>ksh.8000 </strong> - New customer - 12:37 AM</p>
        </div>
        <div class="orders-filters">
            <!-- Add your filters here -->
            <div class="bidding-container" style="background: #b1e6b1; margin: 4px 0; padding: 10px; border: 5px solid #be1f1f; text-align: center;">
                <p>The bid you have placed equals to $15 on 2024.02.08 - 01:12.</p>
                <button class="buttone">Bid</button>
            </div>

            <div style="background: #dac7c7; margin-top: 10px; padding: 10px; color: #1e0505;">
                Press the button if you do not wish to work on this order anymore or you have placed this bid by mistake.
                In case you remove your bid, you will be able to place a bid once again to let the Support Team know you are still willing to work on it.
            </div>
        </div>

        <div class="order-tabs">
            <ul>
                <li><a href="#" class="tablinks active" onclick="openTab(event, 'instructions')">Instructions</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'all-files')">All files</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'messages')">Messages</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'financial')">Financial</a></li>
            </ul>
        </div>

        <!-- Tab contents -->
        <div id="instructions" class="tab-content active-tab-content">
           <div style="display: flex;">
               <!-- Content for Instructions tab goes here -->
               <div class="left_side card" style="font-size: 20px; line-height: 1.5;">
                   <p>Price: <strong>Ksh.8000</strong></p>
                   <p>Deadline <strong style="color: red;">27hrs</strong></p>
                   <p>Task Size Large</p>
                   <p>Type of Service: Programming</p>
                   <p>Discipline: Web programming</p>
                   <p>Programming Language: Javascript</p>
               </div>


               <div class="right_side card">
                   <h3>Paper Instructions</h3>
                  <p>Maize is a versatile crop that can grow in different varieties of soil, water, and climatic conditions. The crop has a wide range of tolerance to temperature conditions but grows well in warm regions where moisture is sufficient. The crop flourishes in regions with rainfall ranging from 1200mm to 2500mm but can adapt to regions receiving rainfall of up to 400 mm. The crop requires warm temperatures of between 15°C and 30 °C and thrives in a range of zones with altitudes ranging from 100 m to 2900 m ASL, depending on the variety.

                      The crop is sensitive to moisture stress around tasseling time and during cob formation. Growth is favorable under a pH ranging from 5-8 with 5.5-7 being optimal because it is sensitive to salinity.
                   </p>
               </div>
           </div>
        </div>


        <div id="all-files" class="tab-content">
            <h3>All Files</h3>

            <div class="file-info">
                <div class="file-icon">📄</div>
                <div class="file-details">
                    <div class="file-name">559227134_IMG_0524_7823323980395078.jpeg</div>
                    <p class="file-description">Instructions / Guidelines</p>
                    <p>Customer</p>
                    <p>7 Feb, 01:23 PM</p>
                    <p>821 KB</p>
                </div>
            </div>

            <!-- Add more file-info divs as needed -->
        </div>

        <div id="messages" class="tab-content">
            <!-- Content for Messages tab goes here -->
            <h3>Messages</h3>
            <p>Messages content goes here...</p>
        </div>
        <div id="financial" class="tab-content">
            <!-- Content for Financial tab goes here -->
            <h3>Financial</h3>
            <p>Financial content goes here...</p>
        </div>
    </section>

@endsection
