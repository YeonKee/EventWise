<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'EventWise')</title>

    <!-- Stylesheet -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/small_logo.png') }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/carousel/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/javascript/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/288dd6b8ec.js" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="venue.js" defer></script>

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/styleFront.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/webchat.css') }}" rel="stylesheet">
    {{--
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/elegant-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slicknav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/venue.css') }}" rel="stylesheet">

    <!-- Form -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header class="header-section">
        <div class="container1">
            <div class="logo">
                <a href="/homepage">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li id="homepage"><a href="/homepage">Home</a></li>
                        <li id="event"><a href="/event/viewByCategory/Webinar_talk">Events</a>
                            <ul class="dropdown">
                                <li><a href="/event/viewByCategory/Webinar_talk">Webinar/Talk</a></li>
                                <li><a href="/event/viewByCategory/Exhibition">Exhibition</a></li>
                                <li><a href="/event/viewByCategory/Sports">Sports</a></li>
                                <li><a href="/event/viewByCategory/Entertainment">Entertainment</a></li>
                                <li><a href="/event/viewByCategory/Workshop">Workshop</a></li>
                                <li><a href="/event/viewByCategory/Charity">Charity</a></li>
                                <li><a href="/event/viewByCategory/Competition">Competition</a></li>
                                <li><a href="/event/viewByCategory/Others">Others</a></li>
                            </ul>
                        </li>
                        <li id="contact"><a href="/contact">Contacts</a></li>
                        <li id="chat"><a href="/chat">Chat</a></li>
                        <li>
                            <form action="/event/search" method="GET">
                                @csrf
                                <div class="form-inline mt-2 mt-md-0 search-bar" style="margin-right: 60px;">
                                    <input type="text" id="txtSearch" class="searchbox" name="search" />
                                    <button id="btnSearch" class='btn btn-success my-2 my-sm-0'><i
                                            class='fa fa-search'></i></button>
                                </div>
                            </form>
                        </li>
                        <button type="button" class="primary-btn top-btn" onclick="location.href = '/becomeorganizer'"
                            style="padding:15px"> Become an organizer</button>

                        <div class="dynamic_btn" style="margin-left:1100px;margin-top:-73px;">
                            @if (session('role') === 'student')
                                <div class="login_icon">
                                    <a href="/students/eventHistory" title="Event History"><i
                                            class="fa fa-history fa-2x"></i></a>
                                    <a href="/students/profile" title="Profile"><i
                                            class="fa fa-user-circle-o fa-2x"></i></a>
                                    <a href="/students/logout" title="Logout"><i
                                            class="fa fa-sign-out fa-2x"></i></a>

                                </div>
                            @else
                                <a class="" style="color: #4452bc; font-size:24px;" href="/students/loginPage"
                                    style="font-family:'Poppins'; ">
                                    Login <i class="fa fa-sign-in"></i>
                                </a>
                            @endif
                        </div>
                    </ul>
                </nav>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>

    @include('sweetalert::alert')

    @yield('body')

    <script>
        document.getElementById('chat').classList.add('active');

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
        $(".chat-form").submit(function(event) {
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
                    console.log("Inside2");

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
            }
        });
    </script>
</body>

</html>
