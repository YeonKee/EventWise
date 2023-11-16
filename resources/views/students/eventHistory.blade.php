@extends('layoutFront')

@section('head')
@endsection

@section('body')
    <div class="container">
        <h3 class="my-4">Event(s) History</h3>
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
                            <td>  <a href="{{ asset($registration->receipt) }}" download>View Receipt</a></td>
                            <td>
                                <a href="/event/viewById/{{$registration->event->event_id}}" title="View">View Event Details</a>
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
@endsection
