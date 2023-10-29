@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Student</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/students/viewStudent">Student</a></li>
                    <li class="breadcrumb-item active">{{ $student->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="profile-content">
                    <div class="profile-info text-center">
                        <h2 class="form-title">Student Profile</h2>

                        <div class="profile-group">
                            <img id="profile_preview" class="mx-auto rounded-circle" src="/img/profile_pic/{{ $student->profile_pic }}"
                                alt="Profile Image" width="170" height="170">
                        </div>

                        <table class="profile-table text-left mb-3" style="width:100%">
                            <tr>
                                <td style="width: 20%"><i class="fa-solid fa-user"></i> Name</td>
                                <td style="width: 5%">: </td>
                                <td style="width: 75%">{{ $student->name }}</td>
                            </tr>

                            <tr>
                                <td><i class="fa-solid fa-id-card"></i> ID</td>
                                <td>: </td>
                                <td>{{ $student->stud_id }}</td>
                            </tr>

                            <tr>
                                <td><i class="fa-solid fa-envelope"></i> Email</td>
                                <td>: </td>
                                <td>{{ $student->email }}</td>
                            </tr>

                            <tr>
                                <td><i class="fa-solid fa-location-dot"></i> Address</td>
                                <td>: </td>
                                <td>{{ $student->address }}</td>
                            </tr>

                            <tr>
                                <td><i class="fa-solid fa-check-circle"></i> Registered At</td>
                                <td>: </td>
                                <td>{{ $student->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
