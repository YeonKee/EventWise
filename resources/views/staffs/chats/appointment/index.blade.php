@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Appointment</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/chats/appointment/viewAppointment">Automated Chat</a></li>
                    <li class="breadcrumb-item active">Appointment</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form d-flex align-items-center" method="GET"
                    action="/staffs/chats/appointment/viewAppointmentSearch">
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
                        <h5 class="card-title">Appointment <span>(Result count: {{ $appointmentsCount }})</span></h5>
                        @php
                            $count = $appointments->firstItem();
                        @endphp
                        <!-- Default Table -->
                        <table class="table" id="appointmentTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col">Contact Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Book At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $appointment->title }}</td>
                                        <td>{{ $appointment->date }}</td>
                                        <td>{{ $appointment->time }}</td>
                                        <td>{{ $appointment->venue }}</td>
                                        <td>{{ $appointment->email }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>{{ $appointment->created_at }}</td>
                                        <td>
                                            <form method="post" action="/staffs/chats/appointment/approveApp"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="app_id" value="{{ $appointment->app_id }}">
                                                <button id="approvedBtn" class="action" title="Approved">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>

                                            <form method="post" action="/staffs/chats/appointment/furtherDiscuss"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="app_id" value="{{ $appointment->app_id }}">
                                                <button id="pendingBtn" class="action" title="Pending">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </button>
                                            </form>

                                            <form method="post"
                                                action="/staffs/chats/appointment/deleteApp/{{ $appointment->app_id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="delBtn" class="action" title="Delete"
                                                    value="{{ $appointment->title }}">
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
                            {{ $appointments->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#chatNav').removeClass('collapsed');
            $('#appointment').addClass('active');
            $('#chat-nav').addClass('show');

            $('#appointmentTable').DataTable({
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
                    title: "Are you sure to delete appointment <b>" + name + "</b>?",
                    html: "The appointment is not recoverable once deleted. <br/><small><i>(An email will be sent to the individual regarding the cancellation of appointment)</i></small>.",
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    reverseButtons: false,
                    buttonsStyling: false,
                    customClass: {
                        cancelButton: 'btn btn-secondary ml-2',
                        confirmButton: 'btn btn-danger mr-2',
                    },
                }).then((respond) => {
                    form.submit();
                });
            }
        });

        function redirectToPage(button) {
            const url = button.getAttribute('data-get');
            window.location.href = url;
        }
    </script>
@endsection
