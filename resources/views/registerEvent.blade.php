@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)
@section('head')
    <link rel="stylesheet" href="venue.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/js/registration.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style type="text/css">
        /* normal css */
        img#picture_preview1 {
            width: 130px;
            height: 130px;
            object-fit: cover;
        }

        img#picture_preview1:hover {
            background-color: white;
            border: 3px dashed #87CEFA;
            cursor: pointer;
        }


        h2,
        h4 {
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
            margin-bottom: 1000px;
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

        #suggestNB {
            margin-top: -35px;
            margin-left: 35px;
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

    <h2><i class="fa fa-pencil mr-2"></i>Event Registration</h2>
    <h5>Come and have fun together!</h5><br>

    <h4 class="box-title mt-5">Register for event:{{ $event->name }}</h4>

    <form id="form1" class="mt-4 h-100" method="POST" action="/event/register" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="event_id" value="{{ $event->event_id }}" />
        <input type="hidden" name="ticket_price" value="{{ $event->ticket_price }}" />

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="part_name">Name
                    <span class="text-danger"><b>*</b>
                        @error('part_name')
                            {{ $message }}
                        @enderror
                    </span></label>
                <input type="text" class="form-control" id="part_name" name="part_name" autocomplete="off"
                    value="{{ old('part_name') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="part_ContactNo">Contact number
                    <span class="text-danger"><b>*</b>
                        @error('part_ContactNo')
                            {{ $message }}
                        @enderror
                    </span></label>
                <input type="text" class="form-control" id="part_ContactNo" name="part_ContactNo" autocomplete="off"
                    value="{{ old('part_ContactNo') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="part_email">Email
                    <span class="text-danger"><b>*</b>
                        @error('part_email')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <input type="text" class="form-control" id="part_email" name="part_email"
                    value="{{ old('part_email') }}">
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="part_add">Address
                    <span class="text-danger"><b>*</b>
                        @error('part_add')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <textarea rows="4" cols="50" class="form-control" id="part_add" name="part_add" style="resize: none">{{ old('part_add') }}</textarea>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="part_city">City
                    <span class="text-danger"><b>*</b>
                        @error('part_city')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <textarea rows="4" cols="50" class="form-control" id="part_city" name="part_city" style="resize: none">{{ old('part_city') }}</textarea>
            </div>
        </div>



        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="part_States">States
                    <span class="text-danger"><b>*</b>
                        @error('open_For')
                            {{ $message }}
                        @enderror
                    </span>
                </label>
                <div class="input-group">
                    <select class="form-control" id="part_States_dropdown" name="part_States_dropdown">
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Terengganu">Terengganu</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Johor">Johor</option>
                        <option value="Perak">Perak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Penang">Penang</option>
                        <option value="Melacca">Melacca</option>
                        <option value="Perlis">Perlis</option>
                    </select>

                </div>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="acc_No">Beneficiary Account</label>
                <input type="text" class="form-control" id="event_name" name="event_name" autocomplete="off"
                    value="{{ $event->bank_Name }}: {{ $event->acc_number }}" style="border: none" readonly>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <div class="profile-group">
                    <label for="payment_qr">QR Payment</label>
                    <img src="{{ $event->payment_qr }}" class="picture-src" id="wizardPicturePreview1" />
                </div>
            </div>
        </div>



        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <label for="ticket_price">Ticket Price (RM):</label>
                <input type="text" class="form-control" id="ticket_price" name="ticket_price" autocomplete="off"
                    value="{{ number_format($event->ticket_price, 2) }}" style="border: none" readonly>
            </div>
        </div>


        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <div class="form-group input-group">
                    <label for="part_receipt">Receipt:
                        <span class="text-danger"><b>*</b>
                            @error('part_receipt')
                                {{ $message }}
                            @enderror
                        </span>
                        <img id="picture_preview" class="mx-auto rounded-circle" src="/img/default_eventpic.png" />
                        <input type="file" class="d-none" name="part_receipt" accept=".jpg, .jpeg, .png" capture>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-row mb-4">
            <div class="col-5 mx-auto">
                <input type="checkbox" id="suggest" name="suggest" value="suggest" checked>
                <label for="suggestNB" id="suggestNB"> I agree that my personal information (Name, contact number and
                    email) can be exposed for Nearby Suggestion feature purposes.</label>
            </div>
        </div>

        <div class="form-row mb-5">
            <div class="col-5 mx-auto recaptcha_box">
                <button type="button" class="btn btn-secondary mr-2" onClick="window.location.reload()">Clear</button>
                <button type="submit" id="submit_regForm" class="btn btn-warning">Submit</button>

            </div>
        </div>
    </form>
@endsection

@section('foot')
@endsection
