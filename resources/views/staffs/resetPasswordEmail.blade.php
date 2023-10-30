@extends('layoutLoginStaff');

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
            <form method="POST" class="register-form" id="register-form" action="/staffs/getCode">
                @csrf
                <div class="signin-content" style="width: 1600px">
                    <div class="signin-form">
                        <h2 class="form-title d-flex justify-content-center">Reset Password</h2>
                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i></label>
                            <input type="email" name="email" id="email" placeholder="Registered Email"
                                value="{{ old('email') }}" />
                        </div>
                        @error('email')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group form-button d-flex justify-content-center">
                            <input type="submit" name="getCode" id="getCode" class="form-submit btn btn-primary" value="Get Verification Code" style="font-weight: bold" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
