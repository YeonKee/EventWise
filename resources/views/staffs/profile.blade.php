@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <h6 style="margin-bottom: 20px"><b>Staff ID: {{ $staff->staff_id }}</b></h5>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Profile</h5>
                    <form class="row g-3" method="POST" id="profile-form" action="/staffs/update">
                        @csrf
                        <input type="hidden" name="actionTaken" value="changeProfile">

                        <div class="col-md-12">
                            <label for="inputName5" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ old('name') ? old('name') : $staff->name }}">
                            @error('name')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" disabled
                                value="{{ $staff->email }}">
                            @error('email')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="update" id="update" >Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr />

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Change Password</h5>
                    <form class="row g-3" method="POST" id="password-form" action="/staffs/update">
                        @csrf
                        <input type="hidden" name="actionTaken" value="changePassword">

                        <div class="col-md-12">
                            <label for="old_pass" class="form-label">Old Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="old_pass" name="old_pass"
                                    placeholder="Old Password" value="{{ old('old_pass') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="toggleOldPasswordVisibility()">
                                        <i class="toggle-icon-old fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            @error('old_pass')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="pass" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass" name="pass"
                                    placeholder="New Password" value="{{ old('pass') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="toggle-icon fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            @error('pass')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="re_pass" class="form-label">Re-enter Password</label>

                            <div class="input-group">
                                <input type="password" class="form-control" id="re_pass" name="re_pass"
                                    placeholder="Re-enter Password" value="{{ old('re_pass') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="toggleRePasswordVisibility()">
                                        <i class="toggle-icon-re fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            @error('re_pass')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="changePass" id="changePass">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#profileNav').removeClass('collapsed');
        });
    </script>
    <script src="/js/account.js"></script>
@endsection
