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
            font-family:'Poppins';
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
                        <img src="{{ $event->event_picture }}" class="img-responsive" width="400" height="300"
                            style="object-fit:scale-down;margin-top: 100px">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6" >
                    <h4 class="box-title mt-5">Event description:</h4>
                    <p>{{ $event->description }}</p>
                    <h4 class="box-title mt-5">Ticket Price(RM):</h4>
                    <p>{{ number_format($event->ticket_price, 2) }}</p>

                    <h4 class="box-title mt-5">Date:</h4>
                    <p>{{ $event->date }}</p>

                    <h4 class="box-title mt-5">Time:</h4>
                    <p>{{ $event->start_time }} - {{ $event->end_time }}</p>

                    <h4 class="box-title mt-5">Duration:</h4>
                    <p>{{ $event->duration }} day(s)</p>

                    <h4 class="box-title mt-5">Capacity:</h4>
                    @if ($event->participated_count > $event->capacity)
                        {{ $event->capacity }}/{{ $event->capacity }} (Capacity reached)
                    @else
                        {{ $event->participated_count }}/{{ $event->capacity }}
                    @endif



                    <br><br>
                    {{-- Check if remaining capacity is greater than 0 --}}
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary"  style="padding: 5px;width:200px; font-size:20px;color:black;margin-top: 20px"onclick="joinEvent()">
                            Join the event!
                        </button>
                    </div>

                    <script>
                        function joinEvent() {
                            var remainingCapacity = {{ $event->capacity - $event->participated_count }};

                            // Check if remaining capacity is 0 or less
                            if (remainingCapacity <= 0) {
                                // Show alert message
                                alert('Sorry, the capacity for the event is full.');
                            } else {
                                // Redirect the user to the registration page
                                window.location.href = "/event/registerEvent/{{ $event->event_id }}";
                            }
                        }
                    </script>


                    {{--                 
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <a
                                 href="/event/registerEvent/{{$event->event_id}}">Join the event!</a></button>
                        </div> --}}
                    {{-- <button type="submit" class="btn btn-primary btn-rounded">Join the event!</button><br> --}}
                </div>
            </div>

        </div>
    </div>


    {{-- <script>
    $('.btn-plus, .btn-minus').on('click', function(e) {
        const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
        const input = $(e.target).closest('.input-group').find('input');
        if (input.is('input')) {
            input[0][isNegative ? 'stepDown' : 'stepUp']()
        }
    });
</script> --}}

    @if (session()->has('successAddCart'))
        <script>
            $(function() {
                $('.successAdd').modal('show');
            });
        </script>
    @elseif (session()->has('failAddCart'))
        <script>
            $(function() {
                $('.failAdd').modal('show');
            });
        </script>
    @endif
@endsection
