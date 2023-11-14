@extends('layoutFront')
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
        img#picture_preview {
            width: 130px;
            height: 130px;
            object-fit: cover;
        }

        img#picture_preview:hover {
            background-color: white;
            border: 3px dashed #87CEFA;
            cursor: pointer;
        }

        img#picture_preview2 {
            width: 130px;
            height: 130px;
            object-fit: cover;
        }

        img#picture_preview2:hover {
            background-color: white;
            border: 3px dashed #87CEFA;
            cursor: pointer;
        }

        h2 {
            text-align: center;
        }

        h5 {
            text-align: center;
            font-style: italic;
        }

        input[type=date],
        input[type=time] {
            width: 200px;
        }

        .ml-2 {
            margin-left: 2.0rem !important;
            margin-right: 0.5rem !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1650px;
        }

        .underline-input {
            position: relative;
        }

        .underline-input input {
            border: none;
            border-bottom: 1px solid #000;
            background-color: transparent;
            width: 100%;
            padding: 5px 0;
        }

        /* Add focus styles if needed */
        .underline-input input:focus {
            border-bottom: 1px solid #00F;

            outline: none;
        }

        label {
            position: relative;
            margin-bottom: 40px;
            top: 20%;
        }

        input[type=text] {
            margin-top: -20px;
        }

        .event_venuearr {
            margin-top: -80px;
        }

        input[type=checkbox] {
            display: block !important;
            margin-top: 10px !important;
        }

        form#form1 label {
            transform: translateY(0%);
            -webkit-transform: translateY(0%);
        }

        #event_remark {
            margin-top: -28px;
        }

        .input-group-append {
            margin-left: -1px;
            margin-top: -28px;
        }

        textarea {
            resize: none;
            overflow-y: scroll;
        }

        .remark_label {
            margin-top: -300px;
            margin-bottom: -30px;
        }
    </style>
@endsection
@section('body')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <input type="hidden" name="event_id" value="{{ $event->event_id }}" />

                <h3 class="card-title"> {{ $event->name }} </h3>

                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="white-box text-center">
                            <img src="{{ $event->event_picture }}" class="img-responsive" width="400" height="300"
                                style="object-fit:scale-down;margin-top: 100px">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <h4 class="box-title mt-5">Event description:</h4>
                        <p>{{ $event->description }}</p>
                        <h4 class="box-title mt-5">Ticket Price(RM):</h4>
                        <p>{{ number_format($event->ticket_price, 2) }}</p>

                        <h4 class="box-title mt-5">Capacity:</h4>
                        <p>{{ $event->capacity }}</p>
                        <h4 class="box-title mt-5">Capacity Available:</h4>
                        <p>{{ $event->capacity - $event->participated_count }}</p>


                        <br><br>
                        {{-- Check if remaining capacity is greater than 0 --}}
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="joinEvent()">
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
