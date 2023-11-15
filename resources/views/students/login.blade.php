@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout);

<style>
    body {
        overflow: hidden;
        /* Hide scrollbars */
    }

    .signin {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>

@section('body')
    <section class="signin">
        <div class="container" style="width: 700px">
            <form method="POST" class="register-form" id="register-form" action="/students/login">
                @csrf
                <div class="signin-content" style="width: 1600px">
                    <div class="signin-form">
                        <h2 class="form-title d-flex justify-content-center">Welcome Back!</h2>
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
