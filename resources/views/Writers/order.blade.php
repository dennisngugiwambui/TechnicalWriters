@extends('Writers.app')

@section('content')


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


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

            <div style="background: #dac7c7; margin-top: 10px; padding: 10px; color: #910707; ">
                Press the button if you do not wish to work on this order anymore or you have placed this bid by mistake.
                In case you remove your bid, you will be able to place a bid once again to let the Support Team know you are still willing to work on it.
            </div>
        </div>

        <div class="order-tabs">
            <ul>
                <li><a href="#" class="tablinks active" onclick="openTab(event, 'instructions')">Instructions</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'all-files')">Files</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'messages')">Messages</a></li>
                <li><a href="#" class="tablinks" onclick="openTab(event, 'financial')">Financial</a></li>
            </ul>
        </div>

        <!-- Tab contents -->
        <div id="instructions" class="tab-content active-tab-content">
           <div class="materials">
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


            <div class="file-part">
                <div class="file-info">
                    <div class="file-details">
                        <div class="file-name">📄 559227134_IMG_0524_7823323980395078.jpeg</div>
                        <p>Instructions / Guidelines</p>
                    </div>
                    <div class="file-metadata">
                        <p>Customer</p>
                        <p>7 Feb, 01:23 PM</p>
                    </div>
                </div>
                <div class="file-info">
                    <div class="file-details">
                        <div class="file-name">📄 559227134_IMG_0524_7823323980395078.jpeg</div>
                        <p>Instructions / Guidelines</p>
                    </div>
                    <div class="file-metadata">
                        <p>Customer</p>
                        <p>7 Feb, 01:23 PM</p>
                    </div>
                </div>
                <div class="file-info">
                    <div class="file-details">
                        <div class="file-name">📄 559227134_IMG_0524_7823323980395078.jpeg</div>
                        <p>Instructions / Guidelines</p>
                    </div>
                    <div class="file-metadata">
                        <p>Customer</p>
                        <p>7 Feb, 01:23 PM</p>
                    </div>
                </div>

                <!-- Styles for Modals -->
                <style>
                    .modal-content {
                        background-color: #f8f9fa;
                    }

                    .modal-header {
                        background-color: #007bff;
                        color: white;
                        border-bottom: 2px solid #0056b3;
                    }

                    .modal-footer {
                        background-color: #f8f9fa;
                        border-top: 2px solid #0056b3;
                    }

                    .btn-primary {
                        background-color: #007bff;
                        border-color: #007bff;
                    }

                    .btn-primary:hover {
                        background-color: #0056b3;
                        border-color: #0056b3;
                    }

                    .file-list {
                        list-style-type: none;
                        padding: 0;
                    }

                    .uploaded-file {
                        background-color: #d4edda;
                        padding: 10px;
                        margin-bottom: 10px;
                        border-radius: 8px;
                    }
                </style>


                <!-- Styles for Modals -->
                <style>
                    .modal-content {
                        background-color: #f8f9fa;
                    }

                    .modal-header {
                        background-color: #cacdd0;
                        color: #2c0505;
                        border-bottom: 2px solid #05080a;
                    }

                    .modal-footer {
                        background-color: #f8f9fa;
                        border-top: 2px solid #94969a;
                    }

                    .btn-primary {
                        background-color: #d38c9a;
                        border-color: #151718;
                    }

                    .btn-primary:hover {
                        background-color: #d38c9a;
                        border-color: #03111f;
                    }

                    .file-list {
                        list-style-type: none;
                        padding: 0;
                    }

                    .uploaded-file {
                        background-color: #d4edda;
                        padding: 10px;
                        margin-bottom: 10px;
                        border-radius: 8px;
                    }

                    .form-select {
                        width: 100%;
                    }

                    .file-type-label {
                        display: block;
                        margin-top: 10px;
                    }
                </style>

                <!-- First Modal -->
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Upload File</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div style="display: flex;">
                                        <div class="mb-3">
                                            <label for="fileInput" class="form-label">Choose File:</label>
                                            <input type="file" class="form-control" id="fileInput" name="fileInput">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fileType" class="form-label">File Type:</label>
                                            <select class="form-select apartment" id="fileType" name="fileType" required>
                                                <option value="completed">Completed</option>
                                                <option value="preview">Preview</option>
                                                <option value="correction">File with Correction</option>
                                            </select>

                                        </div>
                                    </div>
                                </form>
                                <!-- Display uploaded files -->
                                <ul class="file-list">
                                    <!-- List of uploaded files will be displayed here -->
                                </ul>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="buttone" id="uploadFileBtn">Upload File</button>
                                <button type="button" class="buttone" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Next</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Modal -->
                <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Feedback</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Select Option:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="properGrammar" value="properGrammar">
                                            <label class="form-check-label" for="properGrammar">
                                                Proper Grammar
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="noAI" value="noAI">
                                            <label class="form-check-label" for="noAI">
                                                No AI
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="followInstructions" value="followInstructions">
                                            <label class="form-check-label" for="followInstructions">
                                                You have followed all the instructions
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="buttone" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to Upload</button>
                                <button type="submit" class="buttone">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="buttone" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Upload Files</button>
                <p style="background: #d0e3dd; padding: 10px; margin-top: 5px;">Ensure to upload the file and a preview file. Failure to this, the task will be cancelled.</p>

                <script>
                    $(document).ready(function() {
                        // Initialize Select2 for the fileType dropdown
                        $('#fileType').select2({
                            theme: 'bootstrap4', // You can use a different theme if needed
                            placeholder: 'Select File Type',
                            allowClear: true
                        });
                    });


                    document.getElementById('uploadFileBtn').addEventListener('click', function() {
                        // Get the uploaded file
                        var uploadedFile = document.getElementById('fileInput').files[0];
                        var fileType = document.getElementById('fileType').value;

                        if (uploadedFile) {
                            // Create a new list item to display the uploaded file with its type
                            var listItem = document.createElement('li');
                            listItem.className = 'uploaded-file';
                            listItem.textContent = '📄 ' + uploadedFile.name + ' - Type: ' + fileType;

                            // Append the new list item to the file list
                            var fileList = document.querySelector('.file-list');
                            fileList.insertBefore(listItem, fileList.firstChild);

                            // Clear the file input for the next upload
                            document.getElementById('fileInput').value = '';

                            // Reset error message
                            document.getElementById('errorMessage').textContent = '';
                        }
                    });

                    document.getElementById('submitFeedbackBtn').addEventListener('click', function() {
                        // Check if at least 2 files are uploaded
                        var fileList = document.querySelector('.file-list');
                        if (fileList.childElementCount < 2) {
                            // Display error message
                            document.getElementById('errorMessage').textContent = 'Please ensure to upload a preview and the submission file.';
                        } else {
                            // Proceed with submission logic
                            // Add your submission logic here
                        }

                        // Loop through uploaded files and display them
                        for (var i = 0; i < uploadedFiles.length; i++) {
                            var uploadedFile = uploadedFiles[i];

                            // Create a new list item to display the uploaded file with its type
                            var listItem = document.createElement('li');
                            listItem.className = 'uploaded-file';
                            listItem.textContent = '📄 ' + uploadedFile.name + ' - Types: ' + selectedOptions.join(', ');

                            // Append the new list item to the file list
                            var fileList = document.querySelector('.file-list');
                            fileList.insertBefore(listItem, fileList.firstChild);

                            // Clear the file input for the next upload
                            document.getElementById('fileInput').value = '';
                        }
                    });
                </script>

            </div>
        </div>



        <div id="messages" class="tab-content">
            <!-- Content for Messages tab goes here -->
            <h3>Messages</h3>

            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                <span class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                   <p>
                        Support Dpt.>Me
                    Order #556011480: New message
                    31 Jan, 02:23 AM
                   </p>
                </span>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body" style="white-space: pre-line;">
                            Hey Team,

                            We've noticed that chatting with customers isn't always smooth sailing, and it's causing a bit of a headache with revisions and delays.😓

                            We really want to get to the bottom of this and make things better for everyone.

                            So, we're diving into what's going on with communication between you guys and the customers. Our aim? To figure out where things are getting tangled up and how we can untangle them. We think that with a bit of teamwork, we can find ways to make our conversations clearer and order processing smoother.

                            We’ve put together a questionnaire to gather your insights. It’s your chance to share what you’ve noticed, any tricky spots, and your genius ideas for making things better. We will accept responses till the 12th of February.

                            Your feedback is super important. Thank you in advance for your contribution! 🤍

                            Best regards,

                            Nellie

                            STEM Writers Manager
                        </div>
                    </div>
                </div>
            </div>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                <span class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Me>Support Dpt.           Order #556011480: New message         #556011480   31 Jan, 02:22 AM
                </span>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <!-- Your message content goes here -->
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div id="financial" class="tab-content">
            <h3>Financial Overview</h3>

            <!-- Table with card-like appearance -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction Type</th>
                            <th>Comments</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Sample data row (replace with actual data) -->
                        <tr>
                            <td>7th Feb 2024</td>
                            <td>Order Approved</td>
                            <td>Computer Science</td>
                            <td>Ksh.4000</td>
                        </tr>

                        <!-- Add more rows with financial data as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelector('input[type=file]').addEventListener('change', function (e) {
            var fileName = e.target.files[0].name;
            document.querySelector('.file-name').textContent = fileName;
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="text/javascript">

        $("#apartment").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

@endsection
