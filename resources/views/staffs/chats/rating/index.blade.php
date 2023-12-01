@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Rating</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/chats/appointment/viewAppointment">Automated Chat</a></li>
                    <li class="breadcrumb-item active">Rating</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form ratingForm d-flex align-items-center" method="GET"
                    action="/staffs/chats/rating/viewRatingSearch">
                    @csrf
                    <div class="ml-3">
                        <a href="/staffs/chats/rating/ratingScoreMonthly?year=<?php echo date('Y'); ?>" class="btn-rating">View Average Score</a>
                    </div>

                    <input type="text" name="query" placeholder="Search" title="Enter search keyword"
                        style="margin-left: 10px;">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div><!-- End Search Bar -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rating <span>(Result count: {{ $chaRatingsCounts }}) Total Score (Overall):
                                {{ $averageRatings }}%</span></h5>
                        @php
                            $count = $chatRatings->firstItem();
                        @endphp
                        <!-- Default Table -->
                        <table class="table" id="ratingTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Rating Score</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Rate At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chatRatings as $chatRating)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $chatRating->ratings }}</td>
                                        <td>{{ $chatRating->remarks }}</td>
                                        <td>{{ $chatRating->created_at }}</td>
                                        <td>
                                            <form method="post"
                                                action="/staffs/chats/rating/deleteRating/{{ $chatRating->rate_id }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button id="delBtn" class="action" title="Delete">
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
                            {{ $chatRatings->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#chatNav').removeClass('collapsed');
            $('#rating').addClass('active');
            $('#chat-nav').addClass('show');

            $('#ratingTable').DataTable({
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

                var form = this;

                Swal.fire({
                    icon: "warning",
                    title: "Are you sure to delete the rating?",
                    html: "The rating is not recoverable once deleted. <br/><small><i>(Please only delete rating that are irrelevant.)</i></small>",
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
                            html: "Rating is deleted.",
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
