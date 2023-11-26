@extends('layoutFront')

@section('body')

    <div class="card mb-4 shadow-sm"
        style="border-radius: 30px;padding-top:60px;padding-bottom:30px;padding-left:50px;padding-right:50px;margin-left:300px;width:1300px;margin-top:0px;margin-bottom:-500px;">


        <h3 class="card-title" style="font-family:'Poppins';text-align:center; padding-bottom: 25px;">Suggested Nearby
            Participant(s) </h3>
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
                                    target="_blank" title="Contact via WhatsApp"  style="color: #007bff;">{{ $reg->part_contactNo }} </a>
                            </td>
                            {{-- @foreach ($suggestedParticipants as $suggestedParticipant) --}}
                            <td>
                                <a href="mailto:{{ $reg->part_email }}?subject=Joining%20the%20Same%20Event%20{{ $event->name }}&body=Hi%20{{ $reg->part_name }},%0D%0A%0D%0AI%20am%20{{ $reg->part_name }}%20and%20we%20are%20joining%20the%20same%20event%20{{ $event->name }}.%20Do%20you%20mind%20if%20we%20carpool%20to%20the%20event%20destination?"
                                    target="_blank" title="Contact via Email"  style="color: #007bff;">
                                    {{ $reg->part_email }}
                                </a>
                            </td>
                            {{-- @endforeach --}}
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
