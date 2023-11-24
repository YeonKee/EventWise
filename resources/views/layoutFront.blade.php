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
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/elegant-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slicknav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/venue.css') }}" rel="stylesheet" >

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
                                    <a href="/students/logout" title="Logout"><i class="fa fa-sign-out fa-2x"></i></a>
                                    
                                </div>
                            @else
                                <a class="" style="color: #4452bc; font-size:24px;"
                                    href="/students/loginPage" style="font-family:'Poppins'; ">
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

    <!-- Chat bubble -->
    <div class="language-buttons">
        <button class="language-button selected-lang" onclick="setLanguage('en')"
            title="Speak with the Bot in English!">EN</button>
        <button class="language-button" onclick="setLanguage('zh')"
            title="Speak with the Bot in Chiinese!">CH</button>
    </div>

    <script>
        function setLanguage(language) {
            if (language === 'en') {
                // Redirect to a route that dynamically sets the layout to layoutFrontEN
                window.location.href = '/set-layout?layout=layoutFront'; // Replace with your route
            } else if (language === 'zh') {
                // Redirect to a route that dynamically sets the layout to layoutFrontZN
                window.location.href = '/set-layout?layout=layoutFrontZN'; // Replace with your route
            }
        }

        let selectedSocketUrl = 'http://localhost:8090';

        !(function() {
            let e = document.createElement("script"),
                t = document.head || document.getElementsByTagName("head")[0];
            (e.src = "https://cdn.jsdelivr.net/npm/rasa-webchat/lib/index.js"),
            (e.async = !0),
            (e.onload = () => {
                window.WebChat.default({
                        socketUrl: selectedSocketUrl,
                        initPayload: '/greet{"user_id": "' + {!! json_encode(session('studID')) !!} + '"}',
                        title: "EventWise Chat System",
                        socketPath: "/socket.io/",
                    },
                    null
                );
            }),
            t.insertBefore(e, t.firstChild);
        })();
        localStorage.clear();

        let firstClickChat = true;

        // Voice input to text
        const checkExist = setInterval(function() {
            const form = document.querySelector('.rw-sender'); // Select form
            const textarea = document.querySelector('.rw-new-message'); // Select textarea

            if (form && textarea) {
                clearInterval(checkExist);

                const childContent = document.createElement('button');
                childContent.setAttribute('id', 'click_to_record');

                const icon = document.createElement('i');
                icon.classList.add('fas', 'fa-microphone');
                childContent.appendChild(icon);
                childContent.style.backgroundColor = 'transparent';
                childContent.style.border = 'none';

                form.insertBefore(childContent, textarea.nextSibling);

                let recognition; // declare the recognition variable outside the event listener

                // Define a variable to store the transcript
                let savedTranscript = '';

                let isListening = false; // create a flag to check if the microphone is listening
                let firstClick = true; // create a flag to check if the button is clicked for the first time

                childContent.addEventListener('click', function() {
                    if (firstClick) {
                        firstClick = false;
                        Swal.fire({
                            title: 'Microphone activated!',
                            html: 'Click the microphone button again to stop speaking!',
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
                            console.log("Inside");

                            const transcript = Array.from(e.results)
                                .map(result => result[0])
                                .map(result => result.transcript)
                                .join('');

                            savedTranscript = transcript;

                            console.log(savedTranscript);


                            if (textarea) {
                                textarea.value = savedTranscript;
                                textarea.dispatchEvent(new Event('input', {
                                    bubbles: true
                                }));
                                textarea.dispatchEvent(new Event('change', {
                                    bubbles: true
                                }));
                                textarea.innerHTML = savedTranscript;
                            }

                            console.log(transcript);
                        });

                        recognition.start();
                    } else {
                        isListening = false;
                        recognition.stop(); // stop the speech recognition when the button is clicked again
                    }
                });
            }
        }, 100); // Check every 100ms
    </script>
</body>

</html>
