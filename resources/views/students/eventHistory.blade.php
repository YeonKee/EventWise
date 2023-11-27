@extends('layoutFront')

@section('head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        href::after {
            color: black;
        }
    </style>
@endsection

@section('body')
    <div class="card mb-4 shadow-sm"
        style="border-radius: 30px;padding-top:30px;padding-bottom:30px;padding-left:50px;padding-right:50px;margin-left:300px;;width:1300px;margin-top:0px;margin-bottom:-500px;">
        <h3 class="my-4" style="font-family:'Poppins';text-align:center; ">Event(s) History</h3>
        @if ($registrations->isEmpty())
            <p>No events registered.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Event Status</th>
                        <th scope="col">Receipt</th>
                        <th scope="col">Event Details</th>
                        <th scope="col">Nearby Participants Suggestion</th>
                        <!-- Add more columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($registrations as $registration)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $registration->event->name }}</td>
                            <td>{{ $registration->created_at }}</td>
                            <td>{{ $registration->event->date }}</td>
                            <td>{{ $registration->event->event_status }}</td>
                            <td> <a href="{{ asset($registration->receipt) }}" download style="color: #007bff;">View Receipt</a></td>
                            <td>
                                <a href="/event/viewById/{{ $registration->event->event_id }}" title="View">View Event
                                    Details</a>
                            </td>
                            <td>
                                <a href="/event/suggestNearBy/{{ $registration->reg_id }}" title="View">People Nearby
                                    Joining</a>
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        @endif
        {{-- <div class="d-flex justify-content-center">
            {{ $registrations->links('pagination::bootstrap-4') }}
        </div> --}}
    </div>
    @yield('foot')
@endsection
