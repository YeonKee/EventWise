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

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">

            @if ($events->count() > 0)

                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm" style=" display: flex;padding: 5px 30px 10px 30px">

                            <img src="{{$event->event_picture}}" class="bd-placeholder-img card-img-top" width="100%"
                                height="225" style="object-fit:scale-down;padding-top: 15px"
                                xmlns="http://www.w3.org/2000/svg" role="img"
                                aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" /><text x="50%"
                                y="50%" fill="#eceeef" dy=".3em"></text>

                            <div class="card-body">
                                <p class="card-text"><b>{{ $event->name }}</b></p>
                                <p class="card-text">{{ $event->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            <a
                                             href="/event/viewById/{{$event->event_id}}">View</a></button>
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
</div>

    @endsection



    @section('foot')

    @endsection
