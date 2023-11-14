@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Live Chat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Live Chat</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Chat Sessions</h5>
                        <ul>
                            @foreach ($chatSessions as $chatSession)
                                <li>
                                    <a href="/staffs/livechat/{{ $chatSession }}"
                                        id="{{ $chatSession }}">{{ $chatSession }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Chats</h5>
                        <div class="chat">
                            @if (count($messages) > 0)
                                <!-- Header -->
                                <div class="top">
                                    @if (isset($student->profile_pic))
                                        <img src="/img/profile_pic/{{ $student->profile_pic }}" alt="Avatar"
                                            width="70" height="70">
                                    @else
                                        <img src="/img/default_profile.png" alt="Avatar" width="70" height="70">
                                    @endif

                                    <div>
                                        @if (isset($student->name))
                                            <p>{{ $student->name }}</p>
                                        @else
                                            <p>{{ $currentChatSession }}</p>
                                        @endif
                                        <small>Chat Session ID: {{ $currentChatSession }}</small>
                                    </div>

                                    <div style="float: right;">
                                        <form method="post" action="/staffs/livechat/deleteChat/{{ $currentChatSession }}"
                                            id="markAsDone" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button id="solveBtn" class="action" title="Mark as Done"
                                                value="{{ $currentChatSession }}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Header -->

                                <!-- Chat -->
                                <div class="messages">
                                    <!-- Display staff-specific messages -->
                                    @foreach ($messages as $message)
                                        @if ($message->sender_type === 'student' || $message->sender_type === 'normal')
                                            @include('receive', ['message' => $message->message])
                                        @else
                                            @include('broadcast', ['message' => $message->message])
                                        @endif
                                    @endforeach
                                </div>
                                <!-- End Chat -->

                                <!-- Footer -->
                                <div class="bottom">
                                    <form>
                                        <input type="text" id="message" name="message" placeholder="Enter message..."
                                            autocomplete="off">
                                        <button type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                        <button type="button" id="click_to_record">
                                            <i class="fas fa-microphone"></i>
                                        </button>
                                    </form>
                                </div>
                                <!-- End Footer -->
                            @else
                                <p style="text-align: center; padding: 10px; margin-top: 20px;">No messages is available at
                                    the moment. Please select one from the Chat Session(s).</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <script>
        const messagesContainer = $('.messages');

        // Function to scroll messages container to the bottom
        function scrollMessagesToBottom() {
            messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
        }

        scrollMessagesToBottom();

        $(document).ready(function() {
            $('#livechatNav').removeClass('collapsed');
            $('#{{ $currentChatSession }}').addClass('activeChat');
        });

        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: 'ap1',
            debug: true // Enable Pusher debug mode
        });

        const channel = pusher.subscribe('public');

        // Use the student_id from Laravel session as the session_id, or generate a random string
        const session_id = @json($currentChatSession);

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

        // style
        const SwalStyledButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-secondary',
            },
            buttonsStyling: false
        })

        $("#markAsDone").submit(function(e) {
            var solveBtn = $(this).find('#solveBtn');

            if (solveBtn.length > 0) {
                e.preventDefault();

                var name = $(this).find('#solveBtn').val();
                var form = this;

                Swal.fire({
                    icon: "warning",
                    title: "Are you sure to mark chat session <b>" + name + "</b> as done?",
                    text: "The action will clear all the chat session with the particular individual, please proceed with cautious!",
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
                            html: "Chat session <b>" + name + "</b> is deleted.",
                        }).then(function() {
                            form.submit();
                        });
                    }
                });
            }
        });
    </script>
@endsection
