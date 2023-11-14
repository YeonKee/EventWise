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
        class="mt-4 h-100" method="POST" action="/event" enctype="multipart/form-data">
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
                    autocomplete="off" value="{{ old('person_inCharge') }}">
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
                        <option value="Webinar_talk">Webinar/Talk</option>
                        <option value="Exhibitions">Exhibitions</option>
                        <option value="Sports">Sports</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Charity">Charity</option>
                        <option value="Competition">Competition</option>
                        <option value="Festival">Festival</option>
                        <option value="Others">Others</option>
                    </select>

                </div>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="open_For">Open For
                    <span class="text-danger"><b>*</b>
                        @error('open_For')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <div class="input-group">
                    <select class="form-control" id="open_For_dropdown" name="open_For_dropdown">
                        <option value="Public">Public</option>
                        <option value="Students">Students</option>
                    </select>

                </div>
            </div>
        </div>

 


        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="event_desc">Event Description
                    <span class="text-danger"><b>*</b>
                        @error('event_desc')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <textarea rows="4" cols="50" class="form-control" id="event_desc" name="event_desc" style="resize: none">{{ old('event_desc') }}</textarea>
            </div>
        </div>

        
        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <div class="form-group input-group">
                    <label for="event_venueArr">Venue Arrangement:
                        <span class="text-danger"><b>*</b>
                            @error('event_venueArr')
                                {{ $message }}
                            @enderror
                        </span>
                        <img id="picture_preview2" class="mx-auto rounded-circle" src="/img/default_eventpic.png" />
                        <input type="file" class="d-none" name="event_venueArr" accept=".jpg, .jpeg, .png" capture>
                    </label>
                </div>
                <a href="http://127.0.0.1:8000/venueArr">Draw Now</a>
                 
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
                <div class="input-group">
                    <select class="form-control" id="bank_Name_dropdown" name="bank_Name_dropdown">
                        <option value="Maybank">Maybank</option>
                        <option value="Public Bank">Public Bank</option>
                        <option value="RHB Bank">RHB Bank</option>
                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                        <option value="AmBank">AmBank</option>
                        <option value="Bank Rakyat">Bank Rakyat</option>
                        <option value="OCBC Bank">OCBC Bank</option>
                        <option value="HSBC Bank">HSBC Bank</option>
                        <option value="Bank Islam Malaysia">Bank Islam Malaysia</option>
                        <option value="Affin Bank">Affin Bank</option>
                        <option value="Alliance Bank">Alliance Bank</option>
                        <option value="CIMB Bank">CIMB Bank</option>
                    </select>

                </div>
                <input type="text" class="form-control" id="pic_accNo" name="pic_accNo"
                    value="{{ old('pic_accNo') }}" style="margin-top: 10px">
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
                <button type="submit" id="submit_form" class="btn btn-warning">Submit</button>

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
