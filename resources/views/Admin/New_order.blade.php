@extends('Admin.app')

@section('content')



    <style>
        /* Custom styles for the form */
        .add-order-form {
            max-width: 600px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
        }

        /* Styles for the spinner and progress bar */
        .upload-spinner {
            display: none;
        }

        .progress {
            display: none;
            margin-top: 10px;
        }
    </style>

    <div class="container">
        <h2 class="mt-4 mb-4">Add New Order</h2>

        <!-- spinner and progress -->
        <div class="upload-spinner text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="mt-2">Uploading...</div>
        </div>

        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <form class="add-order-form" method="post" action="{{route('orders')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="orderType">Order Type:</label>
                <select class="form-control" id="orderType" name="assignmentType">
                    <option value="available">Available</option>
                    <option value="revision">Revision</option>
                </select>
            </div>

            <div class="form-group">
                <label for="typeOfService">Type of Service:</label>
                <select class="form-control apartment select2"  id="apartment" name="typeOfService"  onchange="updateRoomOptions(this.value)">
                    <option value="programming">Programming</option>
                    <option value="calculations">Calculations</option>
                    <option value="essay">Essay</option>
                    <option value="database">Database</option>
                    <option value="networking">Networking</option>
                    <option value="analysis">Analysis</option>
                    <option value="dissertation">Dissertation</option>
                    <option value="discussion">Discussion</option>
                    <option value="class">Class</option>
                    <option value="reply">Reply</option>
                </select>
            </div>
            <div class="form-group">
                <label for="topicTitle">Topic Title:</label>
                <input type="text" class="form-control" id="topicTitle" name="topicTitle" required>
            </div>

            <div class="form-group">
                <label for="discipline">Discipline:</label>
                <input type="text" class="form-control" id="discipline" name="discipline" required>
            </div>

            <div class="form-group">
                <label for="pages">Number of Pages:</label>
                <input type="number" class="form-control" id="pages" name="pages" required>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline" required>
            </div>

            <div class="form-group">
                <label for="cpp">CPP (Cost Per Page):</label>
                <input type="number" class="form-control" id="cpp" name="cpp" required>
            </div>

            <div class="form-group">
                <label for="cost">Total Cost:</label>
                <input type="text" class="form-control" id="cost" name="cost" readonly>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="comment" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comments</label>
            </div>

            <div class="form-group">
                <label for="files">Additional Files</label>
                <input type="file" class="form-control" id="base64File" name="files">
            </div>



            <button type="submit" class="btn btn-submit">Submit Order</button>
        </form>
    </div>




    <script type="text/javascript">

        $("#apartment").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
    </script>

    <script>
        // Function to calculate and update the total cost
        function updateTotalCost() {
            // Get values from input fields
            var pages = parseFloat($("#pages").val()) || 0;  // Ensure pages is a number
            var cpp = parseFloat($("#cpp").val()) || 0;      // Ensure cpp is a number

            // Calculate total cost
            var totalCost = pages * cpp;

            // Update the total cost field
            $("#cost").val(totalCost.toFixed(2));  // Display total cost with two decimal places
        }

        // Attach the updateTotalCost function to input change events
        $("#pages, #cpp").on("input", function () {
            updateTotalCost();
        });

        // Initial update when the page loads
        updateTotalCost();

        function uploadFile() {
            const fileInput = document.getElementById('files');
            const file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('files', file);

                // Display the spinner and progress bar
                $(".upload-spinner").show();
                $(".progress").show();

                fetch('{{ route("orders") }}', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        // Hide the spinner and progress bar
                        $(".upload-spinner").hide();
                        $(".progress").hide();

                        // Your additional logic after successful upload
                        // ...

                        // Submit the form after file upload if needed
                        // document.getElementById('orderForm').submit();
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Hide the spinner and progress bar in case of an error
                        $(".upload-spinner").hide();
                        $(".progress").hide();
                    });
            }
        }
    </script>


@endsection
