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
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suggestedParticipants as $reg)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $reg->part_name }}</td>

                            <td>
                                <a href="javascript:void(0);"
                                    onclick="sendEmail('{{ $reg->part_email }}', '{{ $reg->part_name }}', '{{ $event->name }}','{{ $senderName->name }}')"
                                    title="Contact via Email" style="color: #007bff;">
                                    Send an email
                                </a>
                            </td>
                          
                            <script>
                                function sendEmail(email, name, eventName,senderName) {
                                    var subject = encodeURIComponent("Joining the Same Event - " + eventName);
                                    var body = encodeURIComponent(
                                        "Hi " + name + "\n" +
                                        "I am " + senderName + " and we are joining the same event " + eventName +
                                        ". Do you mind if we carpool to the event destination?"
                                    );

                                    window.location.href = "mailto:" + email + "?subject=" + subject + "&body=" + body;
                                }
                            </script>

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
