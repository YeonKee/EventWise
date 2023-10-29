@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Staff</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/staffs/viewStaff">Staff</a></li>
                    <li class="breadcrumb-item active">Register</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Register Staff Account</h5>

                <h6 style="margin-bottom: 20px"><b>Staff ID: {{ $staffID }}</b></h5>

                    <form method="POST" class="row g-3 register-form" action="/staffs/staffs/register">
                        @csrf
                        {{-- Hidden field for staff ID --}}
                        <input type="hidden" class="form-control" id="id" name="id"
                            value="{{ $staffID }}">

                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="pass" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass" name="pass"
                                    placeholder="Password" value="{{ old('pass') }}">
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

                        <div class="col-md-6">
                            <label for="re_pass" class="form-label">Re-enter Password</label>

                            <div class="input-group">
                                <input type="password" class="form-control" id="re_pass" name="re_pass"
                                    placeholder="Re-enter Password" value="{{ old('re_pass') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="toggleRePasswordVisibility()">
                                        <i class="toggle-icon fas fa-eye-slash"></i>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#staffNav').removeClass('collapsed');
            $('#registerStaff').addClass('active');
            $('#staff-nav').addClass('show');
        });
    </script>

    <script src="/js/account.js"></script>
@endsection
