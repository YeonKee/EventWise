@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Staff</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/staffs/viewStaff">Staff</a></li>
                    <li class="breadcrumb-item active">Staff Info</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form d-flex align-items-center" method="GET" action="/staffs/staffs/viewStaffSearch">
                    @csrf
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div><!-- End Search Bar -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Staff <span>(Result count: {{ $staffsCount }})</span></h5>
                        @php
                            $count = $staffs->firstItem();
                        @endphp
                        <table class="table" id="staffTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Staff ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Registered At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $staff)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $staff->staff_id }}</td>
                                        <td>{{ $staff->name }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td>{{ $staff->created_at }}</td>
                                        <td>
                                            <form method="post" action="/staffs/staffs/destroy/{{ $staff->staff_id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="delBtn" class="action" title="Delete"
                                                    value="{{ $staff->name }}">
                                                    <input type="hidden" name="query"
                                                        value="{{ request()->input('query') }}">
                                                    <i class="fa fa-trash fa-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center custom-pagination">
                            {{ $staffs->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#staffNav').removeClass('collapsed');
            $('#staffInfo').addClass('active');
            $('#staff-nav').addClass('show');

            var table = $('#staffTable').DataTable({
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
                    title: "Are you sure to delete staff <b>" + name + "</b>?",
                    text: "The staff information and account is not recoverable once deleted.",
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
                            html: "Staff <b>" + name + "</b> is deleted.",
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
