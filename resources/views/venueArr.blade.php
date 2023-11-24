@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)
@section('head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        input[type=checkbox]:not(old)+label {
            margin-top: 18px;
        }
    </style>
@endsection
@section('body')
    <div class="form-row mb-4">
        <div class="col-5 mx-auto">
            <label for="event_venuearr" class="event_venuearr draw-label">Venue Arrangement
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
                        <div class="rowOptions">
                            <label class="titleShapes draw-label">Shapes</label>
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
                                <li class="option tool">
                                    <label for="color-checkbox" class="draw-label">
                                        <input type="checkbox" id="fill-color"
                                            style="background-color: black; display: block">
                                    </label>
                                    <label for="fill-color" class="draw-label">Fill color</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="rowOptions">
                            <label class="titleOptions draw-label">Options</label>
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
                                    <input type="range" id="size-slider" min="1" max="30" value="5">
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row colors">
                        <label class="titleColors draw-label">Colors</label>
                        <ul class="options colors">
                            <li class="color-selection option"></li>
                            <li class="color-selection option selected"></li>
                            <li class="color-selection option"></li>
                            <li class="color-selection option"></li>
                            <li class="color-selection option">
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
                {{-- <input name="venueImage" type="hidden" value="" id="venueImage"> --}}
            </div>
        </div>
    </div>

    <div class="form-row mb-5">
        <div class="col-5 mx-auto recaptcha_box">
            <a href="#" onclick="javascript:window.history.back(-1);return false;" class="submit-event-form btn btn-submit-event"  style="margin-left:10px; ">Back</a>
            {{-- <button type="submit" id="submit_form" class="btn btn-warning">Submit</button> --}}
        </div>
    </div>

    <script src="/js/venue.js" defer></script>
    <script src="/js/register_event.js"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
