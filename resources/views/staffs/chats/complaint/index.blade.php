@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Complaint</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/chats/appointment/viewAppointment">Automated Chat</a></li>
                    <li class="breadcrumb-item active">Complaint</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form d-flex align-items-center" method="GET"
                    action="/staffs/chats/complaint/viewComplaintSearch">
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
                        <h5 class="card-title">Complaint <span>(Result count: {{ $complaintsCount }})</span></h5>
                        @php
                            $count = $complaints->firstItem();
                        @endphp
                        <!-- Default Table -->
                        <table class="table" id="complaintTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">File At</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Updated By</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $complaint)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $complaint->title }}</td>
                                        <td>{{ $complaint->description }}</td>
                                        <td>{{ $complaint->created_at }}</td>
                                        <td>{{ $complaint->status }}</td>
                                        <td>{{ $complaint->updated_by }}</td>
                                        <td>{{ $complaint->updated_at }}</td>
                                        <td>
                                            <form method="post" action="/staffs/chats/complaint/solved"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="comp_id" value="{{ $complaint->comp_id }}">
                                                <button id="approvedBtn" class="action" title="Solved">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>

                                            <form method="post" action="/staffs/chats/complaint/invalid"
                                                class="d-inline">
                                                @csrf
                                                <input type="hidden" name="comp_id" value="{{ $complaint->comp_id }}">
                                                <button id="delBtn" class="action" title="Invalid">
                                                    <i class="fa-solid fa-ban"></i>
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
                            {{ $complaints->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#chatNav').removeClass('collapsed');
            $('#complaint').addClass('active');
            $('#chat-nav').addClass('show');

            $('#complaintTable').DataTable({
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

        function redirectToPage(button) {
            const url = button.getAttribute('data-get');
            window.location.href = url;
        }
    </script>
@endsection
