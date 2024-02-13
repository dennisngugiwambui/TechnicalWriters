@extends('Writers.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
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


    </style>
    <div id="messages" class="tab-content">
        <!-- Content for Messages tab goes here -->
        <h3>Messages</h3>
        <div style="margin: 5px;">
            <button class="buttone" data-bs-toggle="modal" data-bs-target="#exampleModal">New Message</button>

            <!-- Message Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('GeneralMessage')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="recipient" class="form-label">Recipient</label>
                                    <select class="form-control recipient" id="recipient" name="recipient" onchange="updateRoomOptions(this.value)">
                                        <option value="" selected disabled hidden>Select Recipient</option>
                                        <option value="support">Support</option>
                                        <option value="client">Client</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @foreach($messages as $message)
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="heading{{$message->id}}">
                        <h5 class="mb-0">
                    <span class="collapsed" data-toggle="collapse" data-target="#collapse{{$message->id}}" aria-expanded="false" aria-controls="collapse{{$message->id}}">
                        <p>
                            @if(Auth::id() == $message->from)
                                Me > {{$message->to}}
                            @elseif(Auth::id() == $message->to)
                                {{$message->from}} > Me
                            @endif
                            Order #{{$message->orderId}}: {{$message->title}}
                            {{$message->date}}
                        </p>
                    </span>
                        </h5>
                    </div>
                    <div id="collapse{{$message->id}}" class="collapse" aria-labelledby="heading{{$message->id}}" data-parent="#accordion">
                        <div class="card-body" style="white-space: pre-line;">
                            {{$message->message}}
                        </div>
                    </div>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    @endforeach




@endsection
