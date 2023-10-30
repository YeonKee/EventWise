@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Student</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Student</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form d-flex align-items-center" method="GET" action="/staffs/students/viewStudentSearch">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div><!-- End Search Bar -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student  <span>(Result count: {{ $studentsCount }})</span></h5>
                        @php
                            $count = $students->firstItem();
                        @endphp
                        <table class="table" id="studentTable">
                            <thead>
                                <tr>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Registered At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->stud_id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->address }}</td>
                                        <td>{{ $student->created_at }}</td>
                                        <td>
                                            <button data-get="/staffs/students/viewStudentDetail/{{ $student->stud_id }}"
                                                onclick="redirectToPage(this)" class="action" id="viewBtn" title="View">
                                                <i class="fa fa-eye fa-lg"></i>
                                            </button>

                                            <form method="post"
                                                action="/staffs/students/deleteStud/{{ $student->stud_id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="delBtn" class="action" title="Delete"
                                                    value="{{ $student->name }}">
                                                    <i class="fa fa-trash fa-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center custom-pagination">
                            {{ $students->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#studentNav').removeClass('collapsed');

            $('#studentTable').DataTable({
                paging: false, // Disable pagination
                searching: false, // Disable search
                info: false // Disable information display
            });
        });

        // style
        const SwalStyledButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-secondary',
            },
            buttonsStyling: false
        })

        $("form").submit(function(e) {
            var delBtn = $(this).find('#delBtn'); // Assuming the delete button has the id 'delBtn'

            if (delBtn.length > 0) {
                e.preventDefault();

                var name = $(this).find('#delBtn').val();
                var form = this;

                Swal.fire({
                    icon: "warning",
                    title: "Are you sure to delete student <b>" + name + "</b>?",
                    text: "The student information and account is not recoverable once deleted.",
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    reverseButtons: false,
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: 'btn btn-secondary ml-2',
                        confirmButton: 'btn btn-danger mr-2',
                    },
                }).then((respond) => {
                    if (respond.isConfirmed) {
                        SwalStyledButtons.fire({
                            icon: 'success',
                            html: "Student <b>" + name + "</b> is deleted.",
                        }).then(function() {
                            form.submit();
                        });
                    }
                });
            }
        });

        function redirectToPage(button) {
            const url = button.getAttribute('data-get');
            window.location.href = url;
        }
    </script>
@endsection
