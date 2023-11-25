@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)
@section('body')

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       

        <style type="text/css">
            h2 {
                text-align: center;
            }

            h5 {
                text-align: center;
                font-style: italic;
            }


            .ml-2 {
                margin-left: 2.0rem !important;
                margin-right: 0.5rem !important;
            }

            .mt-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 2200px;
            }

            .mb-5 {
                margin-top: 30px;
                margin-bottom: 3rem !important;
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
                margin-left: 500px;
            }

            input[type=text] {
                margin-top: -30px;
            }

            .event_venuearr {
                margin-top: -80px;
            }


            form#form1 label {
                transform: translateY(0%);
                -webkit-transform: translateY(0%);
            }

            #event_remark {
                margin-top: -28px;
                margin-left: 500px;
                width: 800px;
            }

            .input-group-append {
                margin-left: -1px !important;
                margin-top: -28px !important;
            }

            textarea {
                margin-left: 500px;
                resize: none;
                overflow-y: scroll;
            }

            .content_box {
                margin-top: 50px;
            }

            #generate {
                margin-left: 1300px;
                margin-top: -38px;
            }
        </style>
    </head>


    <h2 style="text-align: center;font-family:'Poppins';"><i class="fa fa-pencil mr-2"></i>Become an Organizer</h2>
    <h5 style="text-align: center;font-family:'Poppins';font-style: italic;">Creative, Innovative and Unity</h5><br>

    {{-- <h6 class="message font-weight-bold my-3 text-center
    @if (request()->has('success')) text-success">
    New event submitted successfully. Stay tuned for the updates!(Event ID: {{ request()->get('success') }})
    @elseif (request()->has('error'))
    text-danger">
    Opps, error encountered. Please try again.
    @else
    "> @endif
</h6> --}}
      


        <form action="/event/generate"
        method="post" id="form2" enctype="multipart/form-data">
        @csrf

        <input type="hidden" class="form-control" id="event_id" name="event_id" value="{{ request()->get('success') }}">


        <div class="remark_label">
            <label for="event_remark" style="margin-top:30px;">Remarks
                <span class="text-danger"><b>*</b>
                    @error('event_remark')
                        {{ $message }}
                    @enderror
                </span>
                <br><i>You are required to input few keywords.</i>
            </label>
        </div>

        <input type="text" class="form-control" id="event_remark" name="title" value="{{ $title }}">

        <button class="submit-event-form btn btn-submit-event" type="submit" id="generate">Generate</button>


        </form>
        <form action="/event/generate/update" method="post" id="form3" enctype="multipart/form-data">
            @csrf

            <input type="hidden" class="form-control" id="event_id" name="event_id"
                value="{{ request()->get('success') }}">

            <div class="content_box">
                @if ($content)
                    <textarea name="remark" id="remark" cols="110" rows="4">{{ $content }}</textarea>
                @endif
            </div>

            <div class="form-row mb-5" style="margin-left:-80px;">
                <div class="col-5 mx-auto recaptcha_box">
                    <button type="button" class="clear-event-form btn btn-secondary mr-2"
                        onclick="location.href = '/textGenerator'">Clear</button>
                    <button type="submit" class="submit-event-form btn btn-submit-event" id="submit_mainform">Submit</button>
                </div>
            </div>
        </form>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="/js/textGenerator.js"></script>
    @endsection
