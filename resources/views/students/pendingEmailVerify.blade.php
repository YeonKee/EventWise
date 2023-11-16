@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout);

<style>
    .verifyEmail {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        text-align: center;
        padding: 20px;
    }
</style>

@section('body')
<section class="verifyEmail">
    <div class="container">
        {{-- <img src="https://i.ibb.co/qjSrdf6/logo.png" width=250 height=250 style="margin-bottom: 13px"> --}}
              
        <h2 style="margin-bottom: 15px">Please verify your email</h2>
        <img src="/img/verifyEmail.png" width=250 height=250 style="margin-bottom: 13px">
        <p style="padding: 0 50px; margin-bottom: 35px;">You're almost there! We had sent an email to <br/><span style="font-weight: bold">{{ $email }}</span></p>
        <p style="padding: 0 50px; margin-bottom: 35px;">Just click on the link in the email to complete your signup. If you don't see it, you may need to <b>check your spam</b> folder.</p>
        <p style="padding: 0 50px">Can't find the email?</p>
        <a href="#" style="margin: 7 0;" class="form-submit btn btn-primary" onclick="sendVerificationEmail(event, '{{ $email }}', '{{ $studID }}')">Resend Email</a>
        <p id="successMessage" style="padding: 0 50px; display: none;">Email sent successfully!</p>
    </div>
</section>

<script>
    function sendVerificationEmail(event, email, studID) {
        event.preventDefault();

        // Show loading cursor
        document.body.style.cursor = 'wait';

        var url = "{{ route('verifyEmail', ['email' => ':email', 'studID' => ':studID']) }}";
        url = url.replace(':email', email);
        url = url.replace(':studID', studID);

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                var successMessage = document.getElementById('successMessage');
                successMessage.style.display = 'block';
                // Revert to normal cursor
                document.body.style.cursor = 'default';
            } else {
                console.error('There was a problem sending the email.');
                // Revert to normal cursor in case of an error
                document.body.style.cursor = 'default';
            }
        };

        xhr.onerror = function () {
            console.error('Request failed.');
            // Revert to normal cursor in case of an error
            document.body.style.cursor = 'default';
        };

        xhr.send();
    }
</script>

@endsection
