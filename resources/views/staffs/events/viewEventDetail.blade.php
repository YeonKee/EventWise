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


                        <form method="post" action="/events/update/{{ $event->event_id }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <table class="profile-table text-left mb-3" style="width:100%;margin-left:-250px">

                                <tr>
                                    <div class="form-row mb-4">
                                        <td style="width: 70%">
                                            <div class="col-5 mx-auto">
                                                <label for="event_personInCharge">Person In-charge
                                                    <span class="text-danger"><b>*</b>
                                                        @error('event_personInCharge')
                                                            {{ $message }}
                                                        @enderror
                                                    </span></label>
                                        </td>
                                        <td style="width: 75%">
                                            <input type="text" class="form-control" id="event_personInCharge"
                                                name="event_personInCharge" autocomplete="off"
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
                                    autocomplete="off" value="{{ old('event_picContactNo', $event->person_inCharge) }}">

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
                                value="{{ old('pic_email', $event->person_inCharge) }}">

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
                        <option value="Webinar_talk" {{ old('event_cat_dropdown') == 'Webinar_talk' ? 'selected' : '' }}>
                            Webinar/Talk</option>
                        <option value="Exhibitions" {{ old('event_cat_dropdown') == 'Exhibitions' ? 'selected' : '' }}>
                            Exhibitions</option>
                        <option value="Walkshop" {{ old('event_cat_dropdown') == 'Walkshop' ? 'selected' : '' }}>Sports
                        </option>
                        <option value="Entertainment" {{ old('event_cat_dropdown') == 'Entertainment' ? 'selected' : '' }}>
                            Entertainment</option>
                        <option value="Workshop" {{ old('event_cat_dropdown') == 'Workshop' ? 'selected' : '' }}>Workshop
                        </option>
                        <option value="Charity" {{ old('event_cat_dropdown') == 'Charity' ? 'selected' : '' }}>Charity
                        </option>
                        <option value="Competition" {{ old('event_cat_dropdown') == 'Competition' ? 'selected' : '' }}>
                            Competition</option>
                        <option value="Festival" {{ old('event_cat_dropdown') == 'Festival' ? 'selected' : '' }}>Festival
                        </option>
                        <option value="Others" {{ old('event_cat_dropdown') == 'Others' ? 'selected' : '' }}>Others
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
                        <label for="open_For">Open For
                            <span class="text-danger"><b>*</b>
                                @error('open_For')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <select class="form-control" id="open_For_dropdown" name="open_For_dropdown">
                        <option value="Public" {{ old('open_For_dropdown') == 'Public' ? 'selected' : '' }}>Public</option>
                        <option value="Student" {{ old('open_For_dropdown') == 'Student' ? 'selected' : '' }}>Students
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
                    <textarea rows="4" cols="50" class="form-control" id="event_desc" name="event_desc"
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
                        <img src="{{ $event->event_venuearr }}" class="picture-src" id="wizardPicturePreview" />
                        <input type="file" id="wizard-picture" name="event_venueArr"
                            accept=".gif, .jpg, .jpeg, .png" />
                    </div>
                    <span class="d-block mt-2 mb-4 text-danger" id="profile_err">
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
                        <label for="event_price">Ticket Price(RM)
                            <span class="text-danger"><b>*</b>
                                @error('event_price')
                                    {{ $message }}
                                @enderror
                            </span></label>
                </td>
                <td style="width: 75%">
                    <input type="text" class="form-control" id="event_price" name="event_price" autocomplete="off"
                        value="{{ old('event_price', $event->ticket_price) }}">

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
                    <select class="form-control" id="bank_Name_dropdown" name="bank_Name_dropdown">
                        <option value="Maybank">Maybank</option>
                        <option value="Public Bank">Public Bank</option>
                        <option value="RHB Bank">RHB Bank</option>
                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                        <option value="AmBank">AmBank</option>
                        <option value="Bank Rakyat">Bank Rakyat</option>
                        <option value="OCBC Bank">OCBC Bank</option>
                        <option value="HSCB Bank">HSCB Bank</option>
                        <option value="Bank Islam Malaysia">Bank Islam Malaysia</option>
                        <option value="Affin Bank">Affin Bank</option>
                        <option value="Alliance Bank">Alliance Bank</option>
                        <option value="CIMB Bank">CIMB Bank</option>
                    </select>
            </div>
            <input type="text" class="form-control" id="pic_accNo" name="pic_accNo" autocomplete="off"
                value="{{ old('pic_accNo', $event->ticket_price) }}">
            </div>
        </tr>

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
                    <input type="text" class="form-control" id="event_capacity" name="event_capacity"
                        autocomplete="off" value="{{ old('event_capacity', $event->capacity) }}">

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
                        value="{{ old('event_duration', $event->duartion) }}">

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
                            value="{{ old('event_endTime', $event->start_time) }}">
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
                        <img src="{{ $event->event_picture }}" class="picture-src" id="wizardPicturePreview" />
                        <input type="file" id="wizard-picture" name="event_pic" accept=".gif, .jpg, .jpeg, .png" />
                    </div>
                    <span class="d-block mt-2 mb-4 text-danger" id="profile_err">
                        @error('event_pic')
                            <label class="text-danger mt-2">{{ $message }}</label><br>
                        @enderror
                    </span>

            </div>
            </td>
            </div>
        </tr>

        <tr>
            <th></th>
            <td>
                <button type="submit" id="submit_form" class="btn btn-warning">Save</button>
            </td>
        </tr>

        </table>


        {{-- <div class="form-row mb-4">
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
                                            <option value="Walkshop">Sports</option>
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
                                            <option value="Student">Students</option>
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
                                            <option value="HSCB Bank">HSCB Bank</option>
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
                            <div>
                                    <button type="submit" class="btn btn-warning">Save</button>
                            </div> --}}

        </table>
        </form>
        </div>
        </div>
        </div>
        </div>
    </main>
@endsection
