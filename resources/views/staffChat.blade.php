<!DOCTYPE html>
<html lang="en">

<head>
    <title>Staff Chat Laravel Pusher | Edlin App</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <!-- End JavaScript -->

    <!-- CSS -->
    <link rel="stylesheet" href="/style.css">
    <!-- End CSS -->

</head>

<body>
    <div class="chat">

        <!-- Header -->
        <div class="top">
            <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
            <div>
                <p>Ross Edlin</p>
                <small>Online</small>
            </div>
        </div>
        <!-- End Header -->

        <!-- Chat -->
        <div class="messages">
            <!-- Display staff-specific messages -->
            @foreach ($messages as $message)
                @if ($message->sender_type === 'student')
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
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit"></button>
            </form>
        </div>
        <!-- End Footer -->

    </div>
</body>

<script>
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: 'ap1',
        debug: true // Enable Pusher debug mode
    });

    const channel = pusher.subscribe('public');

    // Use the student_id from Laravel session as the session_id, or generate a random string
    const session_id = '22WMR05586';

    // Receive messages
    channel.bind('chat', function(data) {
        // Check if session_id is equal to 123
        if (data.chat_session === session_id) {
            // Update the UI with the received message
            $(".messages > .message").last().after('<div class="left message"><p>' + data.message +
                '</p></div>');
            $(document).scrollTop($(document).height());
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
            $(document).scrollTop($(document).height());
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
            $(document).scrollTop($(document).height());
        }).fail(function(xhr, status, error) {
            console.error('Failed to broadcast message:', error);
        });
    });

    console.log("Out");
</script>

</html>
