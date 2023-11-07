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
        /* drag and drop */
        .container {
            display: flex;
            width: 100%;
            gap: 10px;
            padding: 10px;
            max-width: 1050px;
            height: 515px;
            margin-top: 70px;
        }

        section {
            background: #fff;
            border-radius: 7px;
        }

        .titleShapes,
        .titleOptions,
        .titleColors {
            font-size: 19px;
            margin-bottom: 200px;
        }

        .titleOptions,
        .titleColors {
            margin-bottom: -30px;
        }

        .titleOptions {
            margin-bottom: 0px;
            margin-top: 15px;
        }

        .titleColors {
            margin-bottom: 0px;
            margin-top: -15px;
        }

        input[type=range] {
            -webkit-appearance: progress-bar !important;
        }

        .rowOptions {
            margin-top: -130px;
        }

        .tools-board {
            width: 210px;
            padding-left: 15px;
        }

        .tools-board .row {
            margin-bottom: 20px;
        }

        .row .options {
            list-style: none;
            margin: 30px 0 0 10px;
        }

        .row .options.shapes {
            margin-left: -57px;
        }

        .row .options.colors {
            margin-left: -50px;
        }

        .row .options .option {
            display: flex;
            cursor: pointer;
            align-items: left;
            margin-bottom: 5px;
        }

        .rowShape .options .option {
            display: flex;
            cursor: pointer;
            align-items: left;
            margin-bottom: 5px;
        }

        .option:is(:hover, .active) img {
            filter: invert(17%) sepia(90%) saturate(3000%) hue-rotate(900deg) brightness(100%) contrast(100%);
        }

        .option :where(span, label) {
            color: #5A6168;
            cursor: pointer;
            padding-left: 10px;
        }

        .option:is(:hover, .active) :where(span, label) {
            color: #4A98F7;
        }

        .option #fill-color {
            cursor: pointer;
            height: 14px;
            width: 14px;
        }

        #fill-color:checked~label {
            color: #4A98F7;
        }

        .option #size-slider {
            width: 100%;
            height: 5px;
            margin-top: 10px;
            padding: 0px;
            margin-bottom: 11px;
        }

        .colors .options {
            display: flex;
            justify-content: space-between;
        }

        .colors .option {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            margin-top: -5px;
            position: relative;
        }

        .colors .option:nth-child(1) {
            background-color: #fff;
            border: 1px solid #bfbfbf;
        }

        .colors .option:nth-child(2) {
            background-color: #000;
        }

        .colors .option:nth-child(3) {
            background-color: #E02020;
        }

        .colors .option:nth-child(4) {
            background-color: #6DD400;
        }

        .colors .option:nth-child(5) {
            background-color: #4A98F7;
        }

        .colors .option.selected::before {
            position: absolute;
            content: "";
            top: 50%;
            left: 50%;
            height: 12px;
            width: 12px;
            background: inherit;
            border-radius: inherit;
            border: 2px solid #fff;
            transform: translate(-50%, -50%);
        }

        .colors .option:first-child.selected::before {
            border-color: #ccc;
        }

        .option #color-picker {
            opacity: 0;
            cursor: pointer;
        }

        .buttons button {
            width: 80%;
            color: #fff;
            border: none;
            outline: none;
            padding: 8px 0;
            font-size: 0.9rem;
            margin-bottom: 13px;
            background: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .buttons .clear-canvas {
            color: #6C757D;
            border: 1px solid #6C757D;
            transition: all 0.3s ease;
        }

        .clear-canvas:hover {
            color: #fff;
            background: #6C757D;
        }

        .buttons .save-img {
            background: #4A98F7;
            border: 1px solid #4A98F7;
        }

        .drawing-board {
            flex: 1;
            overflow: hidden;
            border: 3px solid #000;
        }

        .drawing-board canvas {
            width: 100%;
            height: 100%;
        }

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
            margin-bottom: 1600px;
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
            margin-top: -30px;
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
    <h2><i class="fa fa-pencil mr-2"></i>Become an Organizer</h2>
    <h5>Creative, Innovative and Unity</h5><br>

    <h6 class="message font-weight-bold my-3 text-center
    @if (request()->has('success')) text-success">
    New event submitted successfully. Stay tuned for the updates!(Event ID: {{ request()->get('success') }})
    @elseif (request()->has('error'))
    text-danger">
    Opps, error encountered. Please try again.
    @else
    "> @endif
</h6>

<form id="form1"
        class="mt-4 h-100" method="post" action="/event" enctype="multipart/form-data">
        @csrf

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_personInCharge">Person In-charge
                    <span class="text-danger"><b>*</b>
                        @error('event_personInCharge')
                            {{ $message }}
                        @enderror
                    </span></label>
                <input type="text" class="form-control" id="event_personInCharge" name="event_personInCharge"
                    autocomplete="off" value="{{ old('event_personInCharge') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_picContactNo">Contact number
                    <span class="text-danger"><b>*</b>
                        @error('event_picContactNo')
                            {{ $message }}
                        @enderror
                    </span></label>
                <input type="text" class="form-control" id="event_picContactNo" name="event_picContactNo"
                    autocomplete="off" value="{{ old('event_picContactNo') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="pic_email">Email
                    <span class="text-danger"><b>*</b>
                        @error('pic_email')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <input type="text" class="form-control" id="pic_email" name="pic_email" value="{{ old('pic_email') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_name">Event Name
                    <span class="text-danger"><b>*</b>
                        @error('event_name')
                            {{ $message }}
                        @enderror
                    </span></label>
                <input type="text" class="form-control" id="event_name" name="event_name" autocomplete="off"
                    value="{{ old('event_name') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_cat">Event Category
                    <span class="text-danger"><b>*</b>
                        @error('event_cat')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <div class="input-group">
                    <select class="form-control" id="event_cat_dropdown" name="event_cat_dropdown">
                        <option value="Outdoor">Outdoor</option>
                        <option value="Talk">Talk</option>
                        <option value="Walkshop">Walkshop</option>
                        <option value="Festival">Festival</option>
                        <option value="Exhibition">Exhibition</option>
                        <option value="Others">Others</option>
                    </select>

                </div>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <div id="otherCategory" class="underline-input">
                    <input type="text" class="form-control" id="other_category" name="other_category"
                        placeholder="Please specify the event category">
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var eventCatSelect = document.getElementById('event_cat_dropdown');
                var otherCategory = document.getElementById('otherCategory');

                // Function to toggle the visibility of the otherCategory input
                function toggleOtherCategoryInput() {
                    if (eventCatSelect.value === 'Others') {
                        otherCategory.style.display = 'block';
                    } else {
                        otherCategory.style.display = 'none';
                    }
                }

                // Initial state
                toggleOtherCategoryInput();

                // Event listener to toggle on select change
                eventCatSelect.addEventListener('change', toggleOtherCategoryInput);
            });
        </script>


        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_desc">Event Description
                    <span class="text-danger"><b>*</b>
                        @error('event_desc')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <textarea rows="4" cols="50" class="form-control" id="event_desc" name="event_desc">{{ old('event_desc') }}</textarea>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_venuearr" class="event_venuearr">Venue Arrangement
                    <span class="text-danger"><b>*</b>
                        @error('event_venuearr')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <br>
                <div class="container">
                    <section class="tools-board">
                        <div class="row">
                            <label class="titleShapes">Shapes</label>
                            <ul class="options shapes">
                                <li class="option tool" id="rectangle">
                                    <img src="img/venue/rectangle.svg" alt="">
                                    <span>Rectangle</span>
                                </li>
                                <li class="option tool" id="circle">
                                    <img src="img/venue/circle.svg" alt="">
                                    <span>Circle</span>
                                </li>
                                <li class="option tool" id="triangle">
                                    <img src="img/venue/triangle.svg" alt="">
                                    <span>Triangle</span>
                                </li>
                                <li class="option">
                                    <input type="checkbox" id="fill-color">
                                    <label for="fill-color">Fill color</label>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="rowOptions">
                                <label class="titleOptions">Options</label>
                                <ul class="options">
                                    <li class="option active tool" id="brush">
                                        <img src="img/venue/brush.svg" alt="">
                                        <span>Brush</span>
                                    </li>
                                    <li class="option tool" id="eraser">
                                        <img src="img/venue/eraser.svg" alt="">
                                        <span>Eraser</span>
                                    </li>
                                    <li class="option">
                                        <input type="range" id="size-slider" min="1" max="30"
                                            value="5">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row colors">
                            <label class="titleColors">Colors</label>
                            <ul class="options colors">
                                <li class="option"></li>
                                <li class="option selected"></li>
                                <li class="option"></li>
                                <li class="option"></li>
                                <li class="option">
                                    <input type="color" id="color-picker" value="#4A98F7">
                                </li>
                            </ul>
                        </div>
                        <div class="row buttons">
                            <button class="clear-canvas" type="button">Clear Canva</button>
                            <button class="save-img" type="button">Save As Image</button>
                        </div>
                    </section>
                    <section class="drawing-board">
                        <canvas></canvas>
                    </section>
                    <input name="venueImage" type="hidden" value="" id="venueImage">
                </div>
            </div>
        </div>



        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_price">Ticket Price(RM)
                    <span class="text-danger"><b>*</b>
                        @error('event_price')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <input type="text" class="form-control" id="event_price" name="event_price"
                    value="{{ old('event_price') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="pic_accNo">Beneficiary Account Number
                    <span class="text-danger"><b>*</b>
                        @error('pic_accNo')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <input type="text" class="form-control" id="pic_accNo" name="pic_accNo"
                    value="{{ old('pic_accNo') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_capacity">Capacity
                    <span class="text-danger"><b>*</b>
                        @error('event_capacity')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <input type="text" class="form-control" id="event_capacity" name="event_capacity"
                    value="{{ old('event_capacity') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_date">Event Actual Date
                    <span class="text-danger"><b>*</b>
                        @error('event_date')
                            {{ $message }}
                        @enderror
                    </span></label>
                <input type="date" class="form-control" id="event_date" name="event_date" autocomplete="off"
                    value="{{ old('event_date') }}">
            </div>
        </div>


        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_duration">Event Duration (in days)
                    <span class="text-danger"><b>*</b>
                        @error('event_duration')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <input type="text" class="form-control" id="event_duration" name="event_duration"
                    value="{{ old('event_duration') }}">
            </div>
        </div>


        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_time">Event Time
                    <span class="text-danger"><b>*</b>
                        @error('event_time')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <div class="d-flex">
                    <span class="mr-2">From:</span>
                    <input type="time" class="form-control" id="event_startTime" name="event_startTime"
                        value="{{ old('event_startTime') }}">
                    <span class="ml-2">To:</span>
                    <input type="time" class="form-control" id="event_endTime" name="event_endTime"
                        value="{{ old('event_endTime') }}">
                </div>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <div class="form-group input-group">
                    <label for="event_pic">Event Picture/Poster:
                        <span class="text-danger"><b>*</b>
                            @error('event_pic')
                                {{ $message }}
                            @enderror
                        </span>
                        <img id="picture_preview" class="mx-auto rounded-circle" src="/img/default_eventpic.png" />
                        <input type="file" class="d-none" name="event_pic" accept=".jpg, .jpeg, .png" capture>
                    </label>
                </div>
            </div>
        </div>


        <div class="form-row mb-5">
            <div class="col-5 mx-auto recaptcha_box">
                <button type="button" class="btn btn-secondary mr-2"
                    onclick="location.href = '/becomeorganizer'">Clear</button>
                <button type="button" id="submit" class="btn btn-warning">Submit</button>

            </div>
        </div>
</form>

        <script>
            // $(document).ready(function() {
            //     console.log("What you want!!!!");
            //     console.log($("#form1"));
            //     //validate form input
            //     $("#submit").on('click', function(e) {

            //         console.log("TJL");
            //         return false;
            //         e.preventDefault();

            //     });
            // });
        </script>
    @endsection



    @section('foot')
        {{-- <script>
            $("[data-get]").on("click", function(e) {
                const url = $(this).attr("data-get");
                location = url || location;
            });


            $(document).ready(function() {
                //     var submitButton = document.getElementById("submit_mainform");
                //     submitButton.addEventListener("click", function(e) {
                //         var form = document.getElementById("form1");
                //         form.submit();
                //     });

                //validate form input
                $("#form1").on('submit',function(e) {

                    console.log("TJL");
                    return false;
                    e.preventDefault();

                });
            });
        </script> --}}
    @endsection
