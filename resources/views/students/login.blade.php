@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout);

<style>

   .signin-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    
  
</style>

@section('body')
    <section class="signin">
        <div class="container" style="width: 700px">

            <div class="message text-center

            @php
                $tried = Cookie::get('try_password') ?? 0;
            @endphp

            @if (request()->has('accountNotExist'))
                text-danger">
                No account registered with email: {{ session()->get('noEmail') }}.<br/>
                <a class="text-danger" href="/customers/create"><b>Register an Account?</b></a>
            @elseif ($tried >= $maxAttempts)
                text-danger">
                You have entered wrong password for {{ $maxAttempts }} times.<br/>
                Please <a class="text-danger" href="/customers/resetPassword"><b>reset your password</b></a>
            @elseif (request()->has('wrongPassword'))
                text-danger">
                ID and password not matched. You have <b>{{ $maxAttempts - $tried }}</b> attempt(s) more.
            @else
                text-dark">
                Welcome Back!
            @endif
        </div>

            <form method="POST" class="register-form" id="register-form" action="/students/login">
                @csrf
                <div class="signin-content" style="width: 1600px;margin-bottom: -300px;">
                    <div class="card mb-4 shadow-sm" style="border-radius: 30px;padding-top:30px;padding-bottom:30px;padding-left:50px;padding-right:50px;margin-left:300px;;width:500px;margin-top:-300px;margin-bottom:-500px;">
                        <h2 class="form-title d-flex justify-content-center" style="font-family: 'Poppins'">Welcome Back!</h2>
                        <div class="form-group">
                            <label for="id"><i class="fa-solid fa-id-card"></i></label>
                            <input type="text" name="id" id="id" placeholder="Student ID"
                                value="{{ old('id') }}" />
                        </div>
                        @error('id')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="pass"><i class="fas fa-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password"
                                value="{{ old('pass') }}" />
                            <i class="toggle-icon fas fa-eye-slash" onclick="togglePasswordVisibility()"></i>
                        </div>
                        @error('pass')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group form-button d-flex justify-content-center">
                            <input type="submit" name="login" id="login" class="form-submit btn btn-primary"
                                value="Login" style="font-weight: bold" />
                        </div>
                        <div class="d-flex justify-content-center align-items-center flex-column mt-3">
                            <p class="text-center" style="margin-bottom: 5px">Forgotten password? <a
                                    href="/students/resetPasswordEmail">Click Here!</a></p>
                            <p class="text-center">Do not have an account? <a href="/students/create">Click Here!</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="/js/account.js"></script>
@endsection
