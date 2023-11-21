@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout);

<style>

    .signin {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
    }

    .form-title {
        margin-bottom: 10px !important;
        margin-bottom: 33px;
        font-family: 'Poppins';
    }

    .msg {
        border: 1px solid rgb(200, 200, 200);
        padding: 10px;
        margin-bottom: 15px;
    }
</style>

@section('body')
    <section class="signin">

        <form method="POST" class="register-form" id="register-form" action="/students/resetPassword">
            @csrf
            <div class="signin-content" style="width: 1600px;margin-bottom: -300px;">
                <div class="card mb-4 shadow-sm" style="border-radius: 30px;padding-top:30px;padding-bottom:30px;padding-left:50px;padding-right:50px;margin-left:650px;;width:600px;margin-top:-300px;margin-bottom:-300px;">
                    <h2 class="form-title d-flex justify-content-center" style="font-family:'Poppins'">Reset Password</h2>

                    <p class="msg">
                        Verification code has been sent to your email. If you don't see it, you may need to <b>check
                            your spam</b> folder.
                    </p>

                    <div class="form-group">
                        <label for="pass"><i class="fa-solid fa-code"></i></label>
                        <input type="text" name="code" id="code" placeholder="Verification Code"
                            value="{{ old('code') }}" />
                    </div>
                    @error('code')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror

                    <div class="form-group">
                        <label for="pass"><i class="fa-solid fa-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password"
                            value="{{ old('pass') }}" />
                        <i class="toggle-icon fas fa-eye-slash" onclick="togglePasswordVisibility()"></i>
                    </div>
                    @error('pass')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror

                    <div class="form-group">
                        <label for="re-pass"><i class="fa-solid fa-lock"></i></label>
                        <input type="password" name="re_pass" id="re_pass" placeholder="Re-enter Password"
                            value="{{ old('re_pass') }}" />
                        <i class="toggle-icon-re fas fa-eye-slash" onclick="toggleRePasswordVisibility()"></i>
                    </div>
                    @error('re_pass')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror

                    <div class="form-group form-button d-flex justify-content-center">
                        <input type="submit" name="resetPass" id="resetPass" class="form-submit btn btn-primary"
                            value="Reset Password" style="font-weight: bold" />
                    </div>
                </div>
            </div>
        </form>

    </section>
    @yield('foot')


    <script src="/js/account.js"></script>
@endsection
