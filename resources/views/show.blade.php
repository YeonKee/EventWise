@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)
@section('head')
    <link rel="stylesheet" href="venue.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/js/venue.js" defer></script>
    <script src="/js/register_event.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style type="text/css">
        /* normal css */
        .col-md-4:hover img {
            transform: scale(0.95);
            transition: all 0.6s;
            opacity: 0.5;
            margin-right: 90px;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
            margin-left: 130px;
        }

        .py-5 {
            padding-bottom: 3rem !important;
            margin-left: 300px;
            margin-right: 300px;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
            border-radius: 30px;
        }


        .card-text {
            color: black;
            font-family: 'Poppins', sans-serif;
        }

        .card-title {
            color: black;
            font-family: 'Poppins', sans-serif;
            font-size: 30px;
            margin-left: 20px;
            font-weight: bold;
        }

        .ml-2 {
            margin-left: 2.0rem !important;
            margin-right: 0.5rem !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1650px;
        }

        .mt-5 {
            font-family: 'Poppins';
            font-weight: bold;
            color: black;
            font-size: 20px;
        }

        .card {
            margin-left: 300px;
            margin-right: 300px;
            margin-bottom: 50px;
            border-radius: 30px;
        }

        p {
            font-weight: 30px;
        }

        .btn-submit-event.disabled {
            background-color: grey;
            pointer-events: none;
            color: white;
        }
    </style>
@endsection
@section('body')
    <div class="card" style="border-radius:10px;margin-left:200px;margin-right:200px;margin-bottom:50px;">
        <div class="card-body">

            <input type="hidden" name="event_id" value="{{ $event->event_id }}" />

            <h3 class="card-title" style=" font-family:'Poppins';"> <b>{{ $event->name }}</b> </h3>

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center">
                        <img src="{{ $event->event_picture }}" style="width: 400px;height: 400px;margin-left: 25px;margin-top: 170px;">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h4 class="box-title mt-5">Event description:</h4>
                    <p>{{ $event->description }}</p>
                    <h4 class="box-title mt-5">Ticket Price(RM):</h4>
                    @if ($event->ticket_price == 0.0)
                        <p>Free of Charge</p>
                    @else
                        <p>{{ number_format($event->ticket_price, 2) }}</p>
                    @endif

                    <h4 class="box-title mt-5">Date:</h4>
                    <p>{{ $event->date }}</p>

                    <h4 class="box-title mt-5">Time:</h4>
                    <p>{{ $event->start_time }} - {{ $event->end_time }}</p>

                    <h4 class="box-title mt-5">Duration:</h4>
                    <p>{{ $event->duration }} day(s)</p>

                    <h4 class="box-title mt-5">Capacity:</h4>
                    @if ($event->participated_count >= $event->capacity)
                        {{ $event->capacity }}/{{ $event->capacity }} <b>(Capacity reached)</b>
                    @else
                        {{ $event->participated_count }}/{{ $event->capacity }}
                    @endif



                    <br><br>
                    {{-- Check if remaining capacity is greater than 0 --}}
                    <div class="btn-group">
                        @if($event->event_status != 'Past')
                        <button type="button" class="submit-event-form btn btn-submit-event"
                            style="padding: 5px; width: 200px; font-size: 20px; color: {{ $event->capacity - $event->participated_count <= 0 ? 'white' : 'white' }}"
                            onclick="{{ $event->capacity - $event->participated_count <= 0 ? 'alert(\'Sorry, the capacity for the event is full.\')' : 'joinEvent()' }}"
                            {{ $event->capacity - $event->participated_count <= 0 ? 'disabled' : '' }}>
                            Join the event!
                        </button>
                        @endif
                    </div>

                    <script>
                        function joinEvent() {
                            // Redirect the user to the registration page
                            window.location.href = "/event/registerEvent/{{ $event->event_id }}";
                        }
                    </script>


                </div>

            </div>
        </div>
    @endsection
