@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)

@section('body')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        @import url('https://fonts.cdnfonts.com/css/meldina');

        .col-md-4:hover img {
            transform: scale(0.95);
            transition: all 0.6s;
            opacity: 0.5;
            margin-right: 90px;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
            margin-left: 130px;
        }

        .py-5 {
            padding-bottom: 3rem !important;
            margin-left: 300px;
            margin-right: 300px;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
            border-radius: 30px;
        }

        .eventName {
            font-size: 20px;
            text-align: center;
            font-weight: bold;
            color: black;
            font-family: 'Poppins', sans-serif;
        }

        .banner-container {
            position: relative;
        }

        .banner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 500px;
            background: white;
            border-radius: 30px;

            /* Adjust this value based on your design */
        }

        .banner-text:hover {

            margin-top: -10px;
            transition: 1s;

            /* Adjust this value based on your design */
        }

        .banner {
            width: 1500px;
            margin-left: 200px;
            height: 800px;
            opacity: 0.7;
        }

        #countdown-container {
            text-align: center;
            font-family: 'Poppins';
            margin-top: 20px;
        }

        #countdown_event {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }

        #countdown_event ul {
            list-style: none;
            display: flex;
            padding: 0;
            margin: 0;
        }

        #countdown_event ul li {
            margin: 0 10px;
            text-align: center;
        }

     
    </style>

    @if (isset($closestEvent))
        <div class="banner-container">
            <img src="{{ $closestEvent->event_picture }}" class="banner" alt="Highest Participation Event Image">
            <div class="banner-text">
                <h1 style="font-family: 'Meldina'; text-align: center; margin-bottom: 10px;">It's about to happen!</h1>
                <h2 style="font-family: 'Poppins'; text-align: center;"><b>{{ $closestEvent->name }}</b></h2>
                <h4 style="text-align: center;">{{ $closestEvent->date->format('j F Y') }}</h4>
                <h4 style="color: black; text-align: center;">Time: {{ $closestEvent->start_time }} to
                    {{ $closestEvent->end_time }}</h4>
                <a href="/event/viewById/{{ $closestEvent->event_id }}" class="primary-btn"
                    style="text-align: center; margin-top: 20px; margin-bottom: 30px;">Buy Ticket</a>
            </div>
        </div>

        <div id="countdown-container">
            <h2 style="text-align: center;font-family:'Poppins';">Countdown to the event</h2>
            <div id="countdown_event">
                <ul>
                    <li id="days" style="text-align: center; font-family: 'Poppins'; background-color: #3498db; color: #fff; padding: 10px; border-radius: 5px;"></li>
                    <li id="hours" style="text-align: center; font-family: 'Poppins'; background-color: #e74c3c; color: #fff; padding: 10px; border-radius: 5px;"></li>
                    <li id="minutes" style="text-align: center; font-family: 'Poppins'; background-color: #2ecc71; color: #fff; padding: 10px; border-radius: 5px;"></li>
                    <li id="seconds" style="text-align: center; font-family: 'Poppins'; background-color: #f39c12; color: #fff; padding: 10px; border-radius: 5px;"></li>
                    <li id="text" style="text-align: center; font-family: 'Poppins';"></li>
                </ul>
            </div>
        </div>

        <script>
            // Set the date we're counting down to
            var countDownDate = new Date("{{ $closestEvent->date->format('Y-m-d') }}").getTime();;

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo

                // document.getElementById("demo").innerHTML = days + " Days " + hours + " Hours " +
                //     minutes + " Minutes " + seconds + " Seconds ";

                document.getElementById("days").innerHTML = days + " Days ";
                document.getElementById("hours").innerHTML = hours + " Hours ";
                document.getElementById("minutes").innerHTML = minutes + " Minutes ";
                document.getElementById("seconds").innerHTML = seconds + " Seconds ";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("text").innerHTML = "It's now open for registration";
                }
            }, 1000);
        </script>
    @endif

    <!-- Home About Section Begin -->
    <section class="home-about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ha-pic">
                        <!-- Display an image related to the highest participation event if available -->
                        @if (isset($highestParticipationEvent))
                            <img src="{{ $highestParticipationEvent->event_picture }}"
                                alt="Highest Participation Event Image">
                        @else
                            <!-- Provide a default image or handle the case where no highest participation event is found -->
                            <img src="/img/default-image.jpg" alt="Default Image">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ha-text">
                        <h2 style="font-family:'Poppins'; text-align:center;width: 500px;">Our Most Popular Event!</h2>
                        <p>
                            <!-- Display information about the highest participation event -->
                            @if (isset($highestParticipationEvent))
                                <p style="white-space: nowrap;overflow: hidden;   text-overflow: ellipsis;">
                                    {{ $highestParticipationEvent->description }}</p>
                            @else
                                <div class="container">
                                    <div class="comment-alt" style="height:200px;margin-top:100px">
                                        <p class="text-center" style="font-family: 'Poppins';margin-left:270px;">Opps, no
                                            relevant event found. Stay tune for new event updates!</p>
                                    </div>
                                </div>
                            @endif
                        </p>
                        <a href="/event/viewById/{{ $highestParticipationEvent->event_id }}" class="ha-btn">Discover Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team-member-section">

        <div class="row">
            <div class="col-lg-12">
                <div class="section-title" style="margin-bottom: 10px">
                    <h2>Our Memorable Past Events</h2>
                    <p>These are our amazing past events hosted!</p>
                </div>
            </div>
        </div>

        <div class="album py-5 bg-light">

            <div class="row">
                @if ($events->count() > 0)
                    @foreach ($events as $event)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm" style=" display: flex;padding: 5px 30px 10px 30px">

                                <img src="{{ $event->event_picture }}" style="width: 300px;height:300px;margin-left: 25px;margin-top: 20px;" focusable="false">

                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em"></text>
                                <p class="eventName">{{ $event->name }}</p>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">

                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                style="padding: 7px;width:60px;">
                                                <a href="/event/viewById/{{ $event->event_id }}"
                                                    style="font-size: 15px;color:black">View</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container">
                        <div class="comment-alt" style="height:200px;margin-top:100px">
                            <p class="text-center" style="font-family: 'Poppins';margin-left:270px;">Opps, no relevant event
                                found. Stay tune for new event updates!</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>

    <section class="schedule-section spad">

        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Our Upcoming Events</h2>
                    <p>Do not miss anything topic about the event</p>
                </div>
            </div>
        </div>
        <div class="album py-5 bg-light">

            <div class="row">
                @if ($upcoming->count() > 0)
                    @foreach ($upcoming as $uc)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm" style=" display: flex;padding: 5px 30px 10px 30px">

                                <img src="{{ $uc->event_picture }}" style="width: 300px;height:300px;margin-left: 25px;margin-top: 20px;" focusable="false">

                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%"
                                    fill="#eceeef" dy=".3em"></text>
                                <p class="eventName">{{ $uc->name }}</p>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                style="padding: 7px;width:60px;">
                                                <a href="/event/viewById/{{ $uc->event_id }}"
                                                    style="font-size: 15px;color:black">View</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container">
                        <div class="comment-alt" style="height:200px;margin-top:100px">
                            <p class="text-center" style="font-family: 'Poppins';margin-left:270px;">Opps, no relevant
                                event found. Stay tune for new updates!</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <script>
            document.getElementById('homepage').classList.add('active');
        </script>

        <!-- Js Plugins -->
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.magnific-popup.min.js"></script>
        <script src="/js/jquery.countdown.min.js"></script>
        <script src="/js/jquery.slicknav.js"></script>
        <script src="/js/owl.carousel.min.js"></script>
        <script src="/js/main.js"></script>
    @endsection
