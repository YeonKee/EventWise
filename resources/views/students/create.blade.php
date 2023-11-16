@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)

@section('body')
    <section class="signup">
        <div class="container">
            <form method="POST" class="register-form" id="register-form" action="/students/register"
                enctype="multipart/form-data">
                @csrf
                <div class="signup-content">
                    <div class="form-group input-group signup-image">
                        <label for="profile-input">
                            <img id="profile_preview" class="mx-auto rounded-circle"
                                src="{{ Session::has('imagePath') ? asset('storage/' . session('imagePath')) : '/img/default_profile.png' }}"
                                alt="Profile Image">
                            <br /><br />
                            @error('profile')
                                <small class="text-danger profile-class" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </label>
                        <input id="profile-input" class="d-none" type="file" name="profile"
                            accept=".gif, .jpg, .jpeg, .png" capture onchange="previewImage(event)" value="">
                        @if (Session::has('imagePath'))
                            <input type="hidden" name="imagePath" value="{{ session('imagePath') }}">
                        @endif
                    </div>

                    <div class="signup-form">
                        <h2 class="form-title">Register Account</h2>
                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user"></i></label>
                            <input type="text" name="name" id="name" placeholder="Name"
                                value="{{ old('name') }}" />
                        </div>
                        @error('name')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

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
                            <label for="email"><i class="fa-solid fa-envelope"></i></label>
                            <input type="email" name="email" id="email" placeholder="School Email"
                                value="{{ old('email') }}" />
                        </div>
                        @error('email')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="re-address"><i class="fa-solid fa-location-dot"></i></label>
                            <input type="textarea" name="address" id="address" placeholder="Address"
                                value="{{ old('address') }}" />
                        </div>
                        @error('address')
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

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"
                                style="font-weight: bold" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="/js/account.js"></script>
@endsection
