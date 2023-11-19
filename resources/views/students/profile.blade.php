@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)

@section('body')
    <style>
        .signup-content {
            padding: 0;
        }

        .profile {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
        }

        .container{
            margin-top: 100px;
        }
    </style>

    <section class="profile">
        <div class="card mb-4 shadow-sm" style="border-radius: 30px;padding-top:30px;padding-bottom:30px;padding-left:50px;padding-right:50px;margin-left:40px;;width:1000px;margin-top:-70px;margin-bottom:-300px;">
            <form method="POST" class="profile-form" id="profile-form" action="/students/update"
                enctype="multipart/form-data">
                @csrf
                <div class="signup-content">
                    <div class="form-group input-group signup-image">
                        <label for="profile-input">
                            <img id="profile_preview" class="mx-auto rounded-circle"
                                src="{{ Session::has('imagePath') ? asset('storage/' . session('imagePath')) : '/img/profile_pic/' . $stud->profile_pic }}"
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
                        <h2 class="form-title mt-3" style="font-family: 'Poppins';">Profile Information</h2>
                        <input type="hidden" name="actionTaken" value="changeProfile">
                        <div class="form-group">
                            <label for="id"><i class="fa-solid fa-id-card"></i></label>
                            <input type="text" name="id" id="id" placeholder="Student ID"
                                value="{{ $stud->stud_id }}" disabled />
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i></label>
                            <input type="email" name="email" id="email" placeholder="School Email"
                                value="{{ $stud->email }}" disabled />
                        </div>

                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user"></i></label>
                            <input type="text" name="name" id="name" placeholder="Name"
                                value="{{ old('name') ? old('name') : $stud->name }}" />
                        </div>
                        @error('name')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="re-address"><i class="fa-solid fa-location-dot"></i></label>
                            <input type="textarea" name="address" id="address" placeholder="Address"
                                value="{{ old('address') ? old('address') : $stud->address }}" />
                        </div>
                        @error('address')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group form-button">
                            <input type="submit" name="update" id="update" class="form-submit" value="Update Profile"
                                style="font-weight: bold" />
                        </div>
                    </div>
                </div>
            </form>


            <form method="POST" class="password-form" id="password-form" action="/students/update"
                enctype="multipart/form-data">
                @csrf
                <div class="signup-content">
                    <div class="form-group input-group signup-image">
                    </div>

                    <div class="signup-form">
                        <h2 class="form-title mt-3" style="font-family: 'Poppins';">Change Password</h2>
                        <input type="hidden" name="actionTaken" value="changePassword">

                        <div class="form-group">
                            <label for="old_pass"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" name="old_pass" id="old_pass" placeholder="Old Password"
                                value="{{ old('old_pass') }}" />
                            <i class="toggle-icon-old fas fa-eye-slash" onclick="toggleOldPasswordVisibility()"></i>
                        </div>
                        @error('old_pass')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="pass"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="New Password"
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
                            <input type="submit" name="changePass" id="changePass" class="form-submit"
                                value="Change Password" style="font-weight: bold" />
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <script src="/js/account.js"></script>
@endsection
