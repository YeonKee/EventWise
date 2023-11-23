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

        .eventName {
            font-size: 20px;
            text-align: center;
            font-weight: bold;
            color: black;
            font-family: 'Poppins', sans-serif;
        }


        .ml-2 {
            margin-left: 2.0rem !important;
            margin-right: 0.5rem !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1650px;
        }


        .input-group-append {
            margin-left: -1px;
            margin-top: -28px;
        }

        .card-text {
            color: black;
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endsection
@section('body')

    <div class="album py-5 bg-light">


        <div class="row">

            @if ($events->count() > 0)
                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm" style=" display: flex;padding: 5px 30px 10px 30px; border-radius:10px;margin-left:50px;">

                            <img src="{{ $event->event_picture }}" class="bd-placeholder-img card-img-top" width="100%"
                                height="225" style="object-fit:scale-down;padding-top: 15px"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                dy=".3em"></text>

                            <div class="card-body" >
                                <p class="eventName"  style=" font-family: 'Poppins';">{{ $event->name }}</p>
                                <p class="card-text"  style=" font-family: 'Poppins';">{{ $event->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            style="padding: 7px;width:60px;font-family: 'Poppins';">
                                            <a href="/event/viewById/{{ $event->event_id }}"
                                                style="font-size: 15px;color:black">View</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container">
                    <div class="comment-alt" style="height:200px;margin-top:100px">
                        <p class="text-center">Opps, no relevant event found. Stay tune for new updates!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('event').classList.add('active');
    </script>

@endsection
