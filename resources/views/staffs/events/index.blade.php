@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Event</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form d-flex align-items-center" method="GET" action="/staffs/events/staffEventSearch">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div><!-- End Search Bar -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Event  <span>(Result count: {{ $eventsCount }})</span></h5>
                        @php
                            $count = $events->firstItem();
                        @endphp
                        <table class="table" id="eventTable">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Person In-charge (PIC)</th>
                                    <th scope="col">Ticket Price</th>
                                    <th scope="col">Approval Status</th>
                                    <th scope="col">Registration Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->person_inCharge }}</td>
                                        <td>{{ number_format($event->ticket_price,2) }}</td>
                                        <td>{{ $event->status }}</td>
                                        <td>{{ $event->registration_status }}</td>
                                        <td>
                                            <button data-get="/staffs/events/viewEventDetail/{{ $event->event_id }}"
                                                onclick="redirectToPage(this)" class="action" id="viewBtn" title="View">
                                                <i class="fa fa-eye fa-lg"></i>
                                            </button>

                                            <form method="post"
                                                action="/staffs/events/deleteEvent/{{ $event->event_id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="delBtn" class="action" title="Delete"
                                                    value="{{ $event->name }}">
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
                            {{ $events->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#eventNav').removeClass('collapsed');
            $('#eventInfo').addClass('active');
            $('#event-nav').addClass('show');

            $('#eventTable').DataTable({
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
                    title: "Are you sure to delete event <b>" + name + "</b>?",
                    text: "Please make sure that you have informed the event PIC, as the event information is not recoverable once deleted.",
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
                            html: "Event <b>" + name + "</b> is deleted.",
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
