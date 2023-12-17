@extends('layoutBack')
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
            width: 400px;
            height: 400px;
            object-fit: cover;
        }

        img#picture_preview:hover {
            background-color: white;
            border: 3px dashed #87CEFA;
            cursor: pointer;
        }

        img#picture_preview2 {
            width: 400px;
            height: 400px;
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
            /* position: relative;
                                            margin-bottom: 40px;
                                            top: 20%; */
            display: inline-block;
            width: 300px;
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

        label {
            display: inline-block;
            width: 350px;
        }
    </style>
@endsection

@section('body')
    <script>
        $(document).ready(function() {

            // new profile upload
            $("#wizard-picture1").change(function() {
                // clear error message
                $("#profile_err1").text("");
                // check profile
                var inputLen = this.value.length;
                var file = this.files[0];
                var URL = window.URL || window.webkitURL;
                var picture_regex = new RegExp("image\/(gif|jpe?g|png)");
                // valid file (not more than 1MB, correct format: GIF, JPG, JPEG, PNG)
                if (inputLen && file.size <= (1 * 1024 * 1024) && picture_regex.test(file.type)) {
                    readURL(this);
                } else if (inputLen) {

                    // file format problem
                    if (!picture_regex.test(file.type)) {
                        $("#profile_err1").text(
                            "Please select image in GIF, JPG, JPEG, and PNG format only.");
                    } else if (file.size > (1 * 1024 * 1024)) {
                        $("#profile_err1").text("Please make sure the image size is not more than 1MB.");
                    }

                    $(this).val("");
                    $('[id$=wizardPicturePreview1]').attr('src', $('[id$=wizardPicturePreview1]').attr(
                        "alt"));
                }

            });


            function isEmpty(str) {
                return !$.trim(str);
            }

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('[id$=wizardPicturePreview1]').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            $("#wizard-picture2").change(function() {
                // clear error message
                $("#profile_err2").text("");
                // check profile
                var inputLen = this.value.length;
                var file = this.files[0];
                var URL = window.URL || window.webkitURL;
                var picture_regex = new RegExp("image\/(gif|jpe?g|png)");
                // valid file (not more than 1MB, correct format: GIF, JPG, JPEG, PNG)
                if (inputLen && file.size <= (1 * 1024 * 1024) && picture_regex.test(file.type)) {
                    readURL(this);
                } else if (inputLen) {

                    // file format problem
                    if (!picture_regex.test(file.type)) {
                        $("#profile_err2").text(
                            "Please select image in GIF, JPG, JPEG, and PNG format only.");
                    } else if (file.size > (1 * 1024 * 1024)) {
                        $("#profile_err2").text("Please make sure the image size is not more than 1MB.");
                    }

                    $(this).val("");
                    $('[id$=wizardPicturePreview2]').attr('src', $('[id$=wizardPicturePreview2]').attr(
                        "alt"));
                }

            });

            function isEmpty(str) {
                return !$.trim(str);
            }


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('[id$=wizardPicturePreview2]').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            $("#wizard-picture3").change(function() {
                // clear error message
                $("#profile_err3").text("");
                // check profile
                var inputLen = this.value.length;
                var file = this.files[0];
                var URL = window.URL || window.webkitURL;
                var picture_regex = new RegExp("image\/(gif|jpe?g|png)");
                // valid file (not more than 1MB, correct format: GIF, JPG, JPEG, PNG)
                if (inputLen && file.size <= (1 * 1024 * 1024) && picture_regex.test(file.type)) {
                    readURL(this);
                } else if (inputLen) {

                    // file format problem
                    if (!picture_regex.test(file.type)) {
                        $("#profile_err3").text(
                            "Please select image in GIF, JPG, JPEG, and PNG format only.");
                    } else if (file.size > (1 * 1024 * 1024)) {
                        $("#profile_err3").text("Please make sure the image size is not more than 1MB.");
                    }

                    $(this).val("");
                    $('[id$=wizardPicturePreview3]').attr('src', $('[id$=wizardPicturePreview3]').attr(
                        "alt"));
                }

            });

            function isEmpty(str) {
                return !$.trim(str);
            }


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('[id$=wizardPicturePreview3]').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/events/viewEvent">Event</a></li>
                    <li class="breadcrumb-item active">{{ $event->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="profile-content">
                    <div class="profile-info text-center">
                        <h2 class="form-title">Event Details</h2>


                        <form method="post" action="/events/{{ $event->event_id }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <table class="profile-table text-left mb-3"
                                style="width:100%;margin-left:-150px;margin-top:-400px">

                                <tr>
                                    <div class="form-row mb-4">
                                        <td style="width: 70%">
                                            <div class="col-5 mx-auto">
                                                <label for="event_personInCharge" style="width: 450px">Person In-charge
                                                    <span class="text-danger"><b>*</b>
                                                        @error('event_personInCharge')
                                                            {{ $message }}
                                                        @enderror
                                                    </span></label>
                                        </td>
                                        <td style="width: 75%">
                                            <input type="text" class="form-control" id="event_personInCharge"
                                                name="event_personInCharge" autocomplete="off" style="width: 500px"
                                                value="{{ old('event_personInCharge', $event->person_inCharge) }}">

                                    </div>
                                    </td>
                    </div>
                    </tr>

                    <tr>
                        <div class="form-row mb-4">
                            <td style="width: 70%">
                                <div class="col-5 mx-auto">
                                    <label for="event_picContactNo">PIC Contact Number
                                        <span class="text-danger"><b>*</b>
                                            @error('event_picContactNo')
                                                {{ $message }}
                                            @enderror
                                        </span></label>
                            </td>
                            <td style="width: 75%">
                                <input type="text" class="form-control" id="event_picContactNo" name="event_picContactNo"
                                    autocomplete="off" value="{{ old('event_picContactNo', $event->contact_number) }}">

                        </div>
                        </td>
                </div>
                </tr>
                <tr>
                    <div class="form-row mb-4">
                        <td style="width: 70%">
                            <div class="col-5 mx-auto">
                                <label for="pic_email">PIC Email
                                    <span class="text-danger"><b>*</b>
                                        @error('pic_email')
                                            {{ $message }}
                                        @enderror
                                    </span></label>
                        </td>
                        <td style="width: 75%">
                            <input type="text" class="form-control" id="pic_email" name="pic_email" autocomplete="off"
                                value="{{ old('pic_email', $event->email) }}">

                    </div>
                    </td>
            </div>
            </tr>

            <tr>
                <div class="form-row mb-4">
                    <td style="width: 70%">
                        <div class="col-5 mx-auto">
                            <label for="event_name">Event Name
                                <span class="text-danger"><b>*</b>
                                    @error('event_name')
                                        {{ $message }}
                                    @enderror
                                </span></label>
                    </td>
                    <td style="width: 75%">
                        <input type="text" class="form-control" id="event_name" name="event_name" autocomplete="off"
                            value="{{ old('event_name', $event->name) }}">

                </div>
                </td>
        </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_cat">Event Category
                            <span class="text-danger"><b>*</b>
                                @error('event_cat')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <select class="form-control" id="event_cat_dropdown" name="event_cat_dropdown">
                        <option value="Webinar_talk"
                            {{ old('event_cat_dropdown', $event->category) == 'Webinar_talk' ? 'selected' : '' }}>
                            Webinar/Talk</option>
                        <option value="Exhibitions"
                            {{ old('event_cat_dropdown', $event->category) == 'Exhibitions' ? 'selected' : '' }}>
                            Exhibitions</option>
                        <option value="Sports"
                            {{ old('event_cat_dropdown', $event->category) == 'Sports' ? 'selected' : '' }}>Sports</option>
                        <option value="Entertainment"
                            {{ old('event_cat_dropdown', $event->category) == 'Entertainment' ? 'selected' : '' }}>
                            Entertainment</option>
                        <option value="Workshop"
                            {{ old('event_cat_dropdown', $event->category) == 'Workshop' ? 'selected' : '' }}>Workshop
                        </option>
                        <option value="Charity"
                            {{ old('event_cat_dropdown', $event->category) == 'Charity' ? 'selected' : '' }}>Charity
                        </option>
                        <option value="Competition"
                            {{ old('event_cat_dropdown', $event->category) == 'Competition' ? 'selected' : '' }}>
                            Competition</option>
                        <option value="Others"
                            {{ old('event_cat_dropdown', $event->category) == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="open_For">Open For
                            <span class="text-danger"><b>*</b>
                                @error('open_For')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <select class="form-control" id="open_For_dropdown" name="open_For_dropdown">
                        <option value="Public"
                            {{ old('open_For_dropdown', $event->openFor) == 'Public' ? 'selected' : '' }}>Public</option>
                        <option value="Students"
                            {{ old('open_For_dropdown', $event->openFor) == 'Students' ? 'selected' : '' }}>Students
                        </option>
                    </select>
            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_desc">Event Description
                            <span class="text-danger"><b>*</b>
                                @error('event_desc')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <textarea rows="8" cols="50" class="form-control" id="event_desc" name="event_desc"
                        style="resize: none">{{ old('event_desc', $event->description) }}</textarea>

            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_venueArr">Venue Arrangement:
                            <span class="text-danger"><b>*</b>
                                @error('event_venueArr')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <div class="profile-group">
                        <img src="{{ $event->event_venuearr }}" class="picture-src" id="wizardPicturePreview1"
                            style="width: 539px;height:489px" />
                        <input type="file" id="wizard-picture1" name="event_venueArr"
                            accept=".gif, .jpg, .jpeg, .png" />
                    </div>
                    <span class="d-block mt-2 mb-4 text-danger" id="profile_err1">
                        @error('event_venueArr')
                            <label class="text-danger mt-2">{{ $message }}</label><br>
                        @enderror
                    </span>

            </div>
            </td>
            </div>
        </tr>



        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_price">Ticket Price (RM)
                            <span class="text-danger"><b>*</b>
                                @error('event_price')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <input type="text" class="form-control" id="event_price" name="event_price" autocomplete="off"
                        value="{{ number_format($event->ticket_price, 2) }}">

            </div>
            </td>
            </div>
        </tr>

  
        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="pic_accNo">Beneficiary Account Number
                            <span class="text-danger"><b>*</b>
                                @error('pic_accNo')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>

                <td style="width: 75%">
                    @if ($event->ticket_price == 0.0)
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var bankDropdown = document.getElementById('bank_Name_dropdown');
                            var accNumberInput = document.getElementById('pic_accNo');
                            var qrImage = document.getElementById('wizardPicturePreview3');
        
                            if (bankDropdown && accNumberInput) {
                                bankDropdown.value = 'no_bank_selected';
                                accNumberInput.value = '-';
                                qrImage.src = '/img/default_eventpic.png';
                            }
                        });
                    </script>
                @endif
                    <select class="form-control" id="bank_Name_dropdown" name="bank_Name_dropdown">
                        <option value="no_bank_selected">No Bank Selected</option>
                        <option value="Maybank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'Maybank' ? 'selected' : '' }}>Maybank
                        </option>
                        <option value="Public Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'Public Bank' ? 'selected' : '' }}>
                            Public
                            Bank</option>
                        <option value="RHB Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'RHB Bank' ? 'selected' : '' }}>RHB Bank
                        </option>
                        <option value="Hong Leong Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'Hong Leong Bank' ? 'selected' : '' }}>
                            Hong
                            Leong Bank</option>
                        <option value="AmBank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'AmBank' ? 'selected' : '' }}>AmBank
                        </option>
                        <option value="Bank Rakyat"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'Bank Rakyat' ? 'selected' : '' }}>Bank
                            Rakyat</option>
                        <option value="OCBC Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'OCBC Bank' ? 'selected' : '' }}>OCBC
                            Bank
                        </option>
                        <option value="HSBC Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'HSBC Bank' ? 'selected' : '' }}>HSBC
                            Bank
                        </option>
                        <option value="Bank Islam Malaysia"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'Bank Islam Malaysia' ? 'selected' : '' }}>
                            Bank Islam Malaysia</option>
                        <option value="Affin Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'Affin Bank' ? 'selected' : '' }}>Affin
                            Bank
                        </option>
                        <option value="Alliance Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'Alliance Bank' ? 'selected' : '' }}>
                            Alliance Bank</option>
                        <option value="CIMB Bank"
                            {{ old('bank_Name_dropdown', $event->bank_Name) == 'CIMB Bank' ? 'selected' : '' }}>CIMB
                            Bank
                        </option>
                    </select>

            </div>
            <input type="text" class="form-control" id="pic_accNo" name="pic_accNo" autocomplete="off"
                value="{{ old('pic_accNo', $event->acc_number) }}">
            </div>
        </tr>


        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="payment_qr">QR Payment:
                            <span class="text-danger"><b>*</b>
                                @error('payment_qr')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <div class="profile-group">
                        <img src="{{ $event->payment_qr }}" class="picture-src" id="wizardPicturePreview3"
                            style="width: 539px;height:489px" />
                        <input type="file" id="wizard-picture3" name="payment_qr" accept=".gif, .jpg, .jpeg, .png" />
                    </div>
                    <span class="d-block mt-2 mb-4 text-danger" id="profile_err3">
                        @error('payment_qr')
                            <label class="text-danger mt-2">{{ $message }}</label><br>
                        @enderror
                    </span>

            </div>
            </td>
            </div>
        </tr>

        

        <script>
            var eventPriceInput = document.getElementById('event_price');
            var bankDropdown = document.getElementById('bank_Name_dropdown');
            var accNumberInput = document.getElementById('pic_accNo');
            var qrImage = document.getElementById('wizardPicturePreview3');

            function updatePaymentDetails() {
                var ticketPrice = parseFloat(eventPriceInput.value);

                if (ticketPrice !== 0.00) {

                } else {
                    // Ticket price is zero
                    bankDropdown.value = 'no_bank_selected';
                    accNumberInput.value = '-';
                    qrImage.src = 'img/default_event.png';
                }
            }

            // Attach the updatePaymentDetails function to the input and blur events
            eventPriceInput.addEventListener('input', updatePaymentDetails);
            eventPriceInput.addEventListener('blur', updatePaymentDetails);
        </script>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_capacity">Capacity
                            <span class="text-danger"><b>*</b>
                                @error('event_capacity')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <input type="text" class="form-control" style="width: 100px"
                        value="{{ $event->participated_count }}" readonly>
                </td>
                <td style="width: 75%"><span style="margin-left: -400px">/</span></td>
                <td style="width: 75%">
                    <input type="text" class="form-control" id="event_capacity" name="event_capacity"
                        style="width: 150px;margin-left:-390px" autocomplete="off"
                        value="{{ old('event_capacity', $event->capacity) }}">

            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_date">Event Actual Date
                            <span class="text-danger"><b>*</b>
                                @error('event_date')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <input type="date" class="form-control" id="event_date" name="event_date" autocomplete="off"
                        value="{{ old('event_date', $event->date) }}">

            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_duration">Event Duration (in days)
                            <span class="text-danger"><b>*</b>
                                @error('event_duration')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <input type="text" class="form-control" id="event_duration" name="event_duration"
                        value="{{ old('event_duration', $event->duration) }}">

            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_time">Event Time
                            <span class="text-danger"><b>*</b>
                                @error('event_time')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <div class="d-flex">
                        <span class="mr-2">From:</span>
                        <input type="time" class="form-control" id="event_startTime" name="event_startTime"
                            value="{{ old('event_startTime', $event->start_time) }}">
                        <span class="ml-2">To:</span>
                        <input type="time" class="form-control" id="event_endTime" name="event_endTime"
                            value="{{ old('event_endTime', $event->end_time) }}">
                    </div>

            </div>
            </td>
            </div>
        </tr>


        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_pic">Event Picture/Poster:
                            <span class="text-danger"><b>*</b>
                                @error('event_pic')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <div class="profile-group">
                        <img src="{{ $event->event_picture }}" class="picture-src" id="wizardPicturePreview2"
                            style="width: 539px;height:489px" />
                        <input type="file" id="wizard-picture2" name="event_pic" accept=".gif, .jpg, .jpeg, .png" />
                    </div>
                    <span class="d-block mt-2 mb-4 text-danger" id="profile_err2">
                        @error('event_pic')
                            <label class="text-danger mt-2">{{ $message }}</label><br>
                        @enderror
                    </span>

            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="remark">Remark
                            <span class="text-danger"><b>*</b>
                                @error('remark')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    @if ($event->remark != null)
                        <textarea rows="4" cols="50" class="form-control" id="remark" name="remark" style="resize: none">{{ old('remark', $event->remark) }}</textarea>
                    @else
                        <textarea rows="4" cols="50" class="form-control" id="remark" name="remark" style="resize: none">No remarks from organizer.</textarea>
                    @endif
                </td>

            </div>
            </td>
            </div>
        </tr>


        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="approval_status">Approval Status
                            <span class="text-danger"><b>*</b>
                                @error('approval_status')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <select class="form-control" id="approval_status_dropdown" name="approval_status_dropdown">
                        <option value="Pending"
                            {{ old('approval_status_dropdown', $event->status) == 'Pending' ? 'selected' : '' }}>Pending
                        </option>
                        <option value="Approved"
                            {{ old('approval_status_dropdown', $event->status) == 'Approved' ? 'selected' : '' }}>Approved
                        </option>
                    </select>

            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="registration_status">Registration Status
                            <span class="text-danger"><b>*</b>
                                @error('registration_status')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <select class="form-control" id="registration_status_dropdown" name="registration_status_dropdown">
                        <option value="Closed"
                            {{ old('registration_status_dropdown', $event->registration_status) == 'Closed' ? 'selected' : '' }}>
                            Closed</option>
                        <option value="Open"
                            {{ old('registration_status_dropdown', $event->registration_status) == 'Open' ? 'selected' : '' }}>
                            Open</option>
                    </select>
            </div>
            </td>
            </div>
        </tr>

        <tr>
            <div class="form-row mb-4">
                <td style="width: 70%">
                    <div class="col-5 mx-auto">
                        <label for="event_status">Event Status
                            <span class="text-danger"><b>*</b>
                                @error('event_status')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <select class="form-control" id="event_status_dropdown" name="event_status_dropdown">
                        <option value="Upcoming"
                            {{ old('event_status_dropdown', $event->event_status) == 'Upcoming' ? 'selected' : '' }}>
                            Upcoming</option>
                        <option value="On going"
                            {{ old('event_status_dropdown', $event->event_status) == 'On going' ? 'selected' : '' }}>On
                            going</option>
                        <option value="Past"
                            {{ old('event_status_dropdown', $event->event_status) == 'Past' ? 'selected' : '' }}>Past
                        </option>
                    </select>
            </div>
            </td>
            </div>
        </tr>


        <tr>
            <th></th>
            <td>
                <button type="submit" id="submit_form" class="btn btn-primary">Save</button>
            </td>
        </tr>

        </table>

        </form>
        </div>
        </div>
        </div>
        </div>
    </main>




    <script>
        $("[data-get]").on("click", function(e) {
            const url = $(this).attr("data-get");
            location = url || location;
        });
    </script>
@endsection
