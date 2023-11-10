<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'EventWise')</title>

    <!-- Stylesheet -->
    <link rel="icon" type="image/x-icon" href="http://127.0.0.1:8000/mini_logo.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/carousel/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/javascript/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/288dd6b8ec.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/styleBack.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nice-admin.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">EventWise</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <span class="d-none d-md-block ps-2 mr-3"><b>Current Staff:</b> {{ session('staffName') }}</span>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" id="dashboardNav" href="/staffs/dashboard">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" id="eventNav" href="/staffs/events/viewEvent">
                    <i class="fa fa-calendar"></i>
                    <span>Event</span>
                </a>
            </li><!-- End Event Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" id="studentNav" href="/staffs/students/viewStudent">
                    <i class='fas fa-user-graduate'></i>
                    <span>Student</span>
                </a>
            </li><!-- End Event Nav -->

            @if (session('role') === 'admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" id="staffNav" data-bs-target="#staff-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="fas fa-id-badge"></i><span>Staff</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="staff-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/staffs/staffs/create" class="" id="registerStaff">
                                <i class="bi bi-circle"></i><span>Register</span>
                            </a>
                        </li>
                        <li>
                            <a href="/staffs/staffs/viewStaff" class="" id="staffInfo">
                                <i class="bi bi-circle"></i><span>Staff Info</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Staff Nav -->
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" id="chatNav" data-bs-target="#chat-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="fas fa-comment-alt"></i></i><span>Automated Chat</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="chat-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/staffs/chats/appointment/viewAppointment" class="" id="appointment">
                            <i class="bi bi-circle"></i><span>Appointment</span>
                        </a>
                    </li>
                    <li>
                        <a href="/staffs/chats/complaint/viewComplaint" class="" id="complaint">
                            <i class="bi bi-circle"></i><span>Complaint</span>
                        </a>
                    </li>
                    <li>
                        <a href="/staffs/chats/rating/viewRating" class="" id="rating">
                            <i class="bi bi-circle"></i><span>Rating</span>
                        </a>
                    </li>
                    <li>
                </ul>
            </li><!-- End Staff Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" id="livechatNav" href="/staffs/livechat">
                    <i class="fas fa-comment-dots"></i>
                    <span>Live Chat</span>
                </a>
            </li><!-- End Event Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" id="profileNav" href="/staffs/profile">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Event Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/staffs/logout">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Event Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    @include('sweetalert::alert')

    @yield('body')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>EventWise</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
