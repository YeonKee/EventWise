@extends('layoutFront')

@section('body')
    <main id="main" class="main">
        {{-- <div class="pagetitle">
            <h1>Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/events/viewParticipantList">Event</a></li>
                    <li class="breadcrumb-item active">{{ $event->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title --> --}}

        {{-- <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form d-flex align-items-center" method="GET" action="/staffs/events/staffParticipantSearch">
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div><!-- End Search Bar --> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Suggested Nearby Participants </h5>
                        @php
                            $count = $participantList->firstItem();
                        @endphp

                        @if ($suggestedParticipants->count() > 0)
                            <table class="table" id="eventTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact Number</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suggestedParticipants as $reg)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $reg->part_name }}</td>
                                            <td>
                                                <a href="https://wa.me/{{ $reg->part_contactNo }}?text=I%20am%20{{ $reg->part_name }},%20and%20we%20are%20joining%20the%20same%20event%20{{ $event->name }}.%20Do%20you%20mind%20if%20we%20carpool%20to%20the%20event%20destination?"
                                                   target="_blank"
                                                   title="Contact via WhatsApp"
                                                >
                                                    {{ $reg->part_contactNo }}
                                                </a>
                                            </td>
                                            @foreach ($suggestedParticipants as $suggestedParticipant)
                                                <td>
                                                    <a href="mailto:{{ $suggestedParticipant->part_email }}?subject=Joining%20the%20Same%20Event%20{{ $event->name }}&body=Hi%20{{ $suggestedParticipant->part_name }},%0D%0A%0D%0AI%20am%20{{ $reg->part_name }}%20and%20we%20are%20joining%20the%20same%20event%20{{ $event->name }}.%20Do%20you%20mind%20if%20we%20carpool%20to%20the%20event%20destination?"
                                                        target="_blank" title="Contact via Email">
                                                        {{ $reg->part_email }}
                                                    </a>
                                                </td>
                                            @endforeach
                                        </tr>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center custom-pagination">
                                {{ $participantList->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <p>Opps, seems like there is no participants nearby you joining the same event.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#eventNav').removeClass('collapsed');

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



        function redirectToPage(button) {
            const url = button.getAttribute('data-get');
            window.location.href = url;
        }
    </script>
@endsection
