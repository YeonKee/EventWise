@extends('layoutFront')
@section('body')
    <div class="chat">
        <!-- Header -->
        <div class="top">
            <img src="/img/staffProfile.png" alt="Avatar" height="80" width="80">
            <div>
                <p>EventWise Staffs</p>
                @if (session('studID') != null)
                    <small>Always on coffee break :)</small>
                @else
                    <small style="color: red !important;">Don't refresh your page or we might not be able to reach you again!!</small>
                @endif

            </div>
        </div>
        <!-- End Header -->

        <!-- Chat -->
        <div class="messages">
            @include('receive', ['message' => 'Hey there! We are currently on break!'])
            @include('receive', [
                'message' => 'Please leave a message and we will get back to you as soon as possible!',
            ])
            <!-- Display staff-specific messages -->
            @foreach ($messages as $message)
                @if ($message->sender_type === 'student')
                    @include('broadcast', ['message' => $message->message])
                @else
                    @include('receive', ['message' => $message->message])
                @endif
            @endforeach
        </div>
        <!-- End Chat -->

        <!-- Footer -->
        <div class="bottom">
            <form>
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit">
                    <i class="fas fa-paper-plane"></i>
                </button>
                <button type="button" id="click_to_record">
                    <i class="fas fa-microphone"></i>
                </button>
            </form>
        </div>
        <!-- End Footer -->

    </div>
    </body>

    <script>
        const messagesContainer = $('.messages');

        // Function to scroll messages container to the bottom
        function scrollMessagesToBottom() {
            messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
        }

        scrollMessagesToBottom();

        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: 'ap1',
            debug: true // Enable Pusher debug mode
        });

        const channel = pusher.subscribe('public');

        // Use the student_id from Laravel session as the session_id, or generate a random string
        const session_id = @json(session('studID', Str::random(8)));

        // Receive messages
        channel.bind('chat', function(data) {
            // Check if session_id is equal to 123
            if (data.chat_session === session_id) {
                // Update the UI with the received message
                $(".messages > .message").last().after('<div class="left message"><p>' + data.message +
                    '</p></div>');
                scrollMessagesToBottom();
            } else {
                console.log('Ignoring chat event for session_id:', data.chat_session);
            }
        });

        // Receive messages
        channel.bind('receive', function(data) {
            // Check if session_id is equal to 123
            if (data.chat_session === session_id) {
                // Update the UI with the received message
                $(".messages > .message").last().after('<div class="left message"><p>' + data.message +
                    '</p></div>');
                scrollMessagesToBottom();
            } else {
                console.log('Ignoring chat event for session_id:', data.chat_session);
            }
        });

        // Submit the form to broadcast messages
        $("form").submit(function(event) {
            event.preventDefault();

            // Get the message from the form
            const message = $("form #message").val();

            // Broadcast the 'staff' event to students with the session_id
            $.ajax({
                url: "/broadcast",
                method: 'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    message: message,
                    receiver_id: '0', // All is sent to staff side
                    session_id: session_id, // Use the student_id as the session_id
                }
            }).done(function(res) {
                // Handle the response if necessary
                console.log('Message broadcasted successfully:', message);
                $(".messages > .message").last().after(res);
                $("form #message").val('');
                scrollMessagesToBottom();
            }).fail(function(xhr, status, error) {
                console.error('Failed to broadcast message:', error);
            });
        });

        console.log("Out");

        // Microphone
        const input = document.getElementById('message'); // Fix typo in getElementById
        let recognition; // declare the recognition variable outside the event listener

        // Define a variable to store the transcript
        let savedTranscript = '';
        let isListening = false; // create a flag to check if the microphone is listening

        document.getElementById('click_to_record').addEventListener('click',
            function() { // Add document in front of getElementById
                if (!isListening) {
                    isListening = true;
                    window.SpeechRecognition = window.webkitSpeechRecognition;
                    const recognition = new SpeechRecognition();
                    recognition.interimResults = true;

                    recognition.addEventListener('result', e => {
                        console.log("Inside");

                        const transcript = Array.from(e.results)
                            .map(result => result[0])
                            .map(result => result.transcript)
                            .join('');

                        savedTranscript = transcript;

                        console.log(savedTranscript);

                        if (input) {
                            input.value = savedTranscript;
                            input.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                            input.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                            input.value = savedTranscript;
                        }

                        console.log(transcript);
                    });

                    recognition.start();
                } else {
                    isListening = false;
                    if (recognition) { // Check if recognition is defined before calling stop
                        recognition.stop();
                    }
                }
            });
    </script>
@endsection
