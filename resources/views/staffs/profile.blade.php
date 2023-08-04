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

        <h6 style="margin-bottom: 20px"><b>Staff ID: </b></h5>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Profile</h5>
                <!-- Multi Columns Form -->
                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="inputName5" class="form-label">Name</label>
                        <input type="text" class="form-control" id="inputName5">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail5" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail5">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Multi Columns Form -->
            </div>
        </div>

        <hr/>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Change Password</h5>

                <!-- Multi Columns Form -->
                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="inputName5" class="form-label">Current Password</label>
                        <input type="text" class="form-control" id="inputName5">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail5" class="form-label">New Password</label>
                        <input type="email" class="form-control" id="inputEmail5">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail5" class="form-label">Confirm Password</label>
                        <input type="email" class="form-control" id="inputEmail5">
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
            $('#profileNav').removeClass('collapsed');
        });
    </script>
@endsection
