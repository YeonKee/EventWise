<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'EventWise')</title>

    <!-- Stylesheet -->
    <link rel="icon" type="image/x-icon" href="http://127.0.0.1:8000/mini_logo.ico">
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

    <!-- Form -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        .container1 {
            margin-left: auto;
            margin-right: auto;
            margin-bottom: -100px;
        }

        .logo {
            margin-right: 200px;
            width: 250px;
            height: 250px;
        }

        .nav-menu {
            font-size: 18px;
            margin-left: 50px;
        }

        ul{
            margin-bottom: -10px;
        }

        #btnSearch {
            background-color: pink;
        }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header class="header-section">
        <div class="container1">
            <div class="logo">
                <a href="./index.html">
                    <img src="img/logo.png" alt="">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li class="active"><a href="/homepage">Home</a></li>
                        <li><a href="/aboutus">About</a></li>
                        <li><a href="./speaker.html">Events</a>
                            <ul class="dropdown">
                                <li><a href="#">Outdoors</a></li>
                                <li><a href="#">Talk</a></li>
                                <li><a href="#">Workshop</a></li>
                                <li><a href="#">Festival</a></li>
                                <li><a href="#">Exhibition</a></li>
                                <li><a href="#">Others</a></li>
                            </ul>
                        </li>
                        <li><a href="./schedule.html">Schedule</a></li>
                        <li><a href="/contact">Contacts</a></li>
                        <li>
                            <form action="/event/search" method="GET">
                                @csrf
                                <div class="form-inline mt-2 mt-md-0 search-bar">
                                    <input type="text" id="txtSearch" class="searchbox" name="search" />
                                    <button id="btnSearch" class='btn btn-success my-2 my-sm-0'>
                                        <i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li>
                        {{-- <button data-get="/event/becomeorganizer" onclick="redirectToPage(this)"
                            class="primary-btn top-btn" style="padding:15px"> Become an organizer
                        </button> --}}
                        <button type="button" class="primary-btn top-btn" onclick="location.href = '/becomeorganizer'" style="padding:15px"> Become an organizer</button>
                    {{-- <li><a href="/event/becomeorganizer" onclick="location.href = '/event/becomeorganizer'"class="primary-btn top-btn" style="padding:15px"> Become an organizer </a></li> --}}
                    </ul>
                </nav>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>


     @include('sweetalert::alert') 

    @yield('body')

    <div id="rasa-chat-widget" data-websocket-url="http://localhost:8090/socket.io">
    </div>
    <script src="https://unpkg.com/@rasahq/rasa-chat" type="application/javascript"></script>

    <script>
        let firstClickChat = true;

        // Chatbot usage
        const element = document.querySelector('.css-qmypsf');
        element.addEventListener('click', function() {
            if (firstClickChat) {
                firstClickChat = false;
                Swal.fire({
                    title: 'Let\'s start chatting',
                    html: 'Says hello to our chat to start the conversation!</i></span>',
                    icon: 'info',
                    showConfirmButton: true,
                });
                isListening = true;
            }
        });

        // Voice input to text
        const checkExist = setInterval(function() {
            const parentDiv = document.querySelector('.css-eifp3v');
            const firstChildDiv = document.querySelector('.css-1abdig3');

            if (parentDiv && firstChildDiv) {
                clearInterval(checkExist);
                const secondChildDiv = document.createElement('div');
                parentDiv.insertBefore(secondChildDiv, firstChildDiv.nextSibling);

                const childContent = document.createElement('button');
                childContent.setAttribute('id', 'click_to_record');

                const icon = document.createElement('i');
                icon.classList.add('fas', 'fa-microphone');
                childContent.appendChild(icon);
                childContent.style.backgroundColor = 'transparent';
                childContent.style.border = 'none';
                secondChildDiv.appendChild(childContent);

                const textArea = document.querySelector('.noBorder.variant--default.css-w3c9za');

                let recognition; // declare the recognition variable outside the event listener

                // Define a variable to store the transcript
                let savedTranscript = '';

                let isListening = false; // create a flag to check if the microphone is listening
                let firstClick = true; // create a flag to check if the button is clicked for the first time

                childContent.addEventListener('click', function() {
                    if (firstClick) {
                        firstClick = false;
                        Swal.fire({
                            title: 'Microphone activated',
                            html: 'Click the microphone button again to stop speaking.<br><span style="font-size: smaller; "><i>Please provide an input key to the input before sending.</i></span>',
                            icon: 'info',
                            showConfirmButton: true,
                        });
                        isListening = true;
                    }

                    if (!isListening) {
                        isListening = true;
                        window.SpeechRecognition = window.webkitSpeechRecognition;
                        recognition = new SpeechRecognition();
                        recognition.interimResults = true;

                        recognition.addEventListener('result', e => {
                            const transcript = Array.from(e.results)
                                .map(result => result[0])
                                .map(result => result.transcript)
                                .join('');

                            savedTranscript = transcript;

                            if (textArea) {
                                textArea.value = savedTranscript;
                                textArea.dispatchEvent(new Event('input', {
                                    bubbles: true
                                }));
                                textArea.dispatchEvent(new Event('change', {
                                    bubbles: true
                                }));
                                textArea.innerHTML = savedTranscript;
                            }

                            console.log(transcript);
                        });

                        recognition.start();
                    } else {
                        isListening = false;
                        // recognition.stop(); // stop the speech recognition when the button is clicked again
                    }
                });
            }
        }, 100); // Check every 100ms
    </script>

    {{-- <script>
        // Function to customize the Rasa chat widget
        function customizeRasaChatWidget() {
            // Check if the Rasa chat widget has been fully loaded
            const checkExist = setInterval(function() {
                const parentDiv = document.querySelector('.css-eifp3v');
                const firstChildDiv = document.querySelector('.css-1abdig3');
                if (parentDiv && firstChildDiv) {
                    clearInterval(checkExist);
                    // Create a new div element
                    const secondChildDiv = document.createElement('div');

                    // Insert the secondChildDiv before the firstChildDiv
                    parentDiv.insertBefore(secondChildDiv, firstChildDiv.nextSibling);

                    // Add content to the secondChildDiv
                    const childContent = document.createElement('button');
                    const icon = document.createElement('i');
                    icon.classList.add('fas', 'fa-microphone'); // Add Font Awesome classes for the heart icon
                    childContent.appendChild(icon);
                    childContent.style.backgroundColor = 'transparent';
                    childContent.style.borderColor = 'transparent';
                    secondChildDiv.appendChild(childContent);
                }
            }, 100); // Check every 100ms
        }

        // Call the function to customize the Rasa chat widget
        customizeRasaChatWidget();
    </script> --}}

    {{-- <!-- Chat bubble -->
>>>>>>> 7be31dcb873df1cf804e618e0feb5000465fdf6f
    <div class="chat-bubble" onclick="toggleChatWindow()">
        <i class="fas fa-comments"></i>
    </div>

    <!-- Chat window -->
    <div class="chat-window" id="chatWindow" style="display: none;">
        <!-- Chat window content goes here -->
        <div class="chat-header">
            <span class="close-btn" onclick="toggleChatWindow()">&times;</span>
            <h4>Chat with Real Staff</h4>
        </div>
        <div class="chat-body">
            <a href="/chat">Click here to chat with real staff</a>
        </div>
    </div>

    <script>
        function toggleChatWindow() {
            var chatWindow = document.getElementById('chatWindow');
            if (chatWindow.style.display === 'none') {
                chatWindow.style.display = 'block';
            } else {
                chatWindow.style.display = 'none';
            }
        }
    </script> --}}
</body>

</html>
