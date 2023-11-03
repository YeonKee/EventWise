@extends('layoutFront')
@section('body')

    <head>

        <link rel="stylesheet" href="venue.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/js/venue.js" defer></script>

        <style type="text/css">

            .container {
                display: flex;
                width: 100%;
                gap: 10px;
                padding: 10px;
                max-width: 1050px;
            }

            section {
                background: #fff;
                border-radius: 7px;
            }

            .tools-board {
                width: 210px;
                padding: 15px 22px 0;
            }

            .tools-board .row {
                margin-bottom: 20px;
            }

            .row .options {
                list-style: none;
                margin: 10px 0 0 5px;
            }

            .row .options .option {
                display: flex;
                cursor: pointer;
                align-items: center;
                margin-bottom: 10px;
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
            }

            .colors .options {
                display: flex;
                justify-content: space-between;
            }

            .colors .option {
                height: 20px;
                width: 20px;
                border-radius: 50%;
                margin-top: 3px;
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
                width: 100%;
                color: #fff;
                border: none;
                outline: none;
                padding: 11px 0;
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
                border:3px solid #000;
            }

            .drawing-board canvas {
                width: 100%;
                height: 100%;
            }

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
                margin-bottom: 1200px;
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
        </style>
    </head>


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
                <input type="text" class="form-control" id="event_picContactNoe" name="event_picContactNo"
                    autocomplete="off" value="{{ old('event_picContactNo') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="prod_name">Event Name
                    <span class="text-danger"><b>*</b>
                        @error('prod_name')
                            {{ $message }}
                        @enderror
                    </span></label>
                <input type="text" class="form-control" id="prod_name" name="prod_name" autocomplete="off"
                    value="{{ old('prod_name') }}">
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
                    <select class="form-control" id="event_cat" name="event_cat">
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
                var eventCatSelect = document.getElementById('event_cat');
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
                <input type="text" class="form-control" id="event_desc" name="event_desc"
                    value="{{ old('event_desc') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_venuearr">Venue Arrangement
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
                            <label class="title">Shapes</label>
                            <ul class="options">
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
                            <label class="title">Options</label>
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
                        <div class="row colors">
                            <label class="title">Colors</label>
                            <ul class="options">
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
                            <button class="clear-canvas">Clear Canvas</button>
                            <button class="save-img">Save As Image</button>
                        </div>
                    </section>
                    <section class="drawing-board">
                        <canvas></canvas>
                    </section>
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


        {{-- <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="prod_endTime">Event End Time
                    <span class="text-danger"><b>*</b>
                        @error('prod_endTime')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <input type="time" class="form-control" id="prod_endTime" name="prod_endTime"
                    value="{{ old('prod_endTime') }}">
            </div>
        </div> --}}


        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <div class="form-group input-group">
                    <label for="prod_pic">Event Picture/Poster:
                        <img id="picture_preview" class="mx-auto rounded-circle" src="/img/default_eventpic.png" />
                        <input class="d-none" type="file" name="prod_pic" accept=".jpg, .jpeg, .png" capture>
                        <span class="text-danger"><b>*</b>
                            @error('prod_pic')
                                {{ $message }}
                            @enderror
                        </span></label>
                </div>
            </div>
        </div>


        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_remark">Remarks
                    <span class="text-danger"><b>*</b>
                        @error('event_remark')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="event_remark" name="event_remark"
                        value="{{ old('event_remark') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Generate</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-row mb-5">
            <div class="col-5 mx-auto recaptcha_box">
                <button type="button" class="btn btn-secondary mr-2"
                    onclick="location.href = '/products/create'">Clear</button>
                <button type="submit" class="btn btn-warning">Submit</button>
            </div>
        </div>

        </form>
    @endsection

    @section('foot')
        <script src="/js/register_event.js"></script>
       
        <script>
            $("[data-get]").on("click", function(e) {
                const url = $(this).attr("data-get");
                location = url || location;
            });
        </script>
    @endsection