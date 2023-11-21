@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout);

<style>

    .signin {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
    }
</style>

@section('body')
    <section class="signin">
      
            <form method="POST" class="register-form" id="register-form" action="/students/getCode">
                @csrf
                <div class="signin-content" style="width: 1000px;margin-left:400px;margin-top:10px">
                    <div class="card mb-4 shadow-sm" style="border-radius: 30px;padding-top:30px;padding-bottom:30px;padding-left:50px;padding-right:50px;margin-left:300px;;width:500px;">
                        <h2 class="form-title d-flex justify-content-center" style="font-family: 'Poppins'">Reset Password</h2>
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
       
    </section>
    @yield('foot')
@endsection
