@extends('Writers.app')

@section('content')


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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

        #all-files {
            display: none; /* Initially hide the content */
        }

        /* Add this CSS to your existing styles */

        .file-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow effect */
        }

        .file-name {
            font-weight: bold;
            margin-right: 10px;
        }

        .file-details {
            flex-grow: 1;
        }

        .file-metadata {
            flex-shrink: 0;
            text-align: right;
            color: #6c757d;
        }
        .message-container {
            margin-top: 20px;
        }

        .message {
            background-color: #f8f9fa;
            padding: 15px;
            display: flex;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .message-sender {
            font-weight: bold;
        }

        .message-title {
            margin-top: 5px;
            color: #343a40;
        }

        .message-date {
            margin-top: 5px;
            color: #6c757d;
        }

        .materials {
            display: flex;
            font-family: 'Arial', sans-serif;
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-upload input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .upload-btn-wrapper {
            border: 2px solid gray;
            color: gray;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            overflow: hidden;
            cursor: pointer;
        }

        .btn {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .upload-btn-wrapper:hover {
            border-color: #3498db;
            color: #3498db;
        }

        .file-name {
            padding-left: 10px;
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

            .file-info {
                display: flex;
                align-items: center;
                justify-content: space-between; /* Adjust spacing between file name and details */
                margin-bottom: 10px;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow effect */
            }

            .file-name {
                font-weight: bold;
                margin-right: 10px;
                font-size: 16px; /* Reduce font size */
            }

            .file-details {
                flex-grow: 1;
                font-size: 10px;
            }

            .file-metadata {
                display: none;
            }
            .materials {
                display: block;
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


    <style>
        .buttone[disabled] {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>

    <section class="orders">
        <div class="orders-header">
            <p><span>FINANCE</span>
                <button class="buttone" onclick="checkDateAndDisable(this)">Request Payment</button>
            </p>
            <p>You can request payment twice a month from <strong>2nd day of the month</strong> and from <strong>17th</strong> day ((start-end at 3pm)</p>
        </div>

        <div class="orders-filters">
            <!-- Add your filters here -->
            <div class="bidding-container" style="background: #b1e6b1; margin: 4px 0; padding: 10px; border: 5px solid #be1f1f; text-align: center;">
                <p>Thank you for being part of me.</p>
            </div>
        </div>

        <div class="order-tabs">
            <ul>
                <li><a href="#" class="tablinks active" onclick="openTab(event, 'unrequested')">Unrequested</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'history')">History</a></li>
            </ul>
        </div>

        <div id="unrequested" class="tab-content">
            <h3>Uncleared Balance</h3>
            <section class="orders">
                <div class="orders-table">
                    <table class="table orders-table-content table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th class="orders-table-header">PAYMENT DATE</th>
                            <th class="orders-table-header">COMPANY NAME</th>
                            <th class="orders-table-header">REQUEST NUMBER</th>
                            <th class="orders-table-header">AMOUNT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="orders-table-data">2024-02-12</td>
                            <td class="orders-table-data">Example Company</td>
                            <td class="orders-table-data">123456</td>
                            <td class="orders-table-data">+$500.00</td>
                        </tr>
                        <tr>
                            <td class="orders-table-data">2024-02-14</td>
                            <td class="orders-table-data">Another Company</td>
                            <td class="orders-table-data">789012</td>
                            <td class="orders-table-data">-$200.00</td>
                        </tr>
                        <!-- Add more rows with uncleared balance data as needed -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div id="history" class="tab-content">
            <h3>Payment History</h3>
            <div class="file-part">
                <!-- Details for Payment History tab -->
            </div>
        </div>




        <script>
        // Get the deadline timestamp from the HTML element
        const deadline = new Date(document.getElementById('deadline').innerText).getTime();

        // Update the countdown every second
        const countdownInterval = setInterval(updateCountdown, 1000);

        // Function to calculate and update the countdown
        function updateCountdown() {
            // Get the current time
            const currentTime = new Date().getTime();

            // Calculate the time remaining in milliseconds
            const timeRemaining = deadline - currentTime;

            // Check if the deadline has passed
            if (timeRemaining <= 0) {
                clearInterval(countdownInterval); // Stop the countdown if deadline has passed
                document.getElementById('timeRemaining').innerText = 'Deadline has passed';
            } else {
                // Convert milliseconds to hours and minutes
                const hours = Math.floor(timeRemaining / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));

                // Display the time remaining
                document.getElementById('timeRemaining').innerText = `(${hours}hrs ${minutes}mins)`;
            }
        }

        // Initial call to update countdown when the page loads
        updateCountdown();
    </script>


    <script>
        document.querySelector('input[type=file]').addEventListener('change', function (e) {
            var fileName = e.target.files[0].name;
            document.querySelector('.file-name').textContent = fileName;
        });
    </script>

    <script>
        // Assuming globalCalendar is a variable containing the current date information
        // You may need to adjust the logic to get the current date from your global calendar
        const globalCalendar = {
            get currentDate() {
                // Assuming this returns the current date
                return new Date();
            }
        };

        function checkDateAndDisable(button) {
            const currentDate = globalCalendar.currentDate;
            const dayOfMonth = currentDate.getDate();

            // Check if the day is either 17 or 2
            if (dayOfMonth !== 17 && dayOfMonth !== 2) {
                button.disabled = true;
            } else {
                // Enable the button if the condition is met
                button.disabled = false;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript">


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

@endsection
