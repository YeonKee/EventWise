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
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">EventWise</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div><!-- End Logo -->
    </header><!-- End Header -->

    @include('sweetalert::alert')

    @yield('body')

    <div id="rasa-chat-widget" data-websocket-url="http://localhost:8090/socket.io">
    </div>
    <script src="https://unpkg.com/@rasahq/rasa-chat" type="application/javascript"></script>

    <script>
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

                // Define a variable to store the transcript
                let savedTranscript = '';

                childContent.addEventListener('click', function() {
                    var speech = true;
                    window.SpeechRecognition = window.webkitSpeechRecognition;

                    const recognition = new SpeechRecognition();
                    recognition.interimResults = true;

                    const textArea = document.querySelector('.noBorder.variant--default.css-w3c9za');

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
                            textArea.innerHTML = 'Yay';
                        }

                        console.log(transcript);
                    });

                    if (speech == true) {
                        recognition.start();
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
