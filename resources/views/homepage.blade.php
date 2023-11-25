@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)

@section('body')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

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
    </style>

    @if (isset($closestEvent))
        <section class="hero-section set-bg" data-setbg={{ $closestEvent->event_picture }}>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="hero-text" style=" width: 500px;  margin-left: 300px;">
                            <h1 style="font-family:'Poppins'; text-align:center;margin-top: -140px;">It's about to happen!</h1>
                            <h2 style="font-family:'Poppins'; text-align:center">{{ $closestEvent->event_name }}</h2>
                            <h4 style="text-align:center">{{ $closestEvent->date->format('j F Y') }}</h4>
                            <h4 style="color: black;text-align:center">Time:{{ $closestEvent->start_time }} to {{ $closestEvent->end_time }}</h4>
                            <a href="/event/viewById/{{ $closestEvent->event_id }}" class="primary-btn" style=" margin-left: 170px; margin-top: 20px;margin-bottom:30px; ">Buy Ticket</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Hero Section End -->

    <!-- Home About Section Begin -->
    <section class="home-about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ha-pic">
                        <!-- Display an image related to the highest participation event if available -->
                        @if(isset($highestParticipationEvent))
                            <img src="{{ $highestParticipationEvent->event_picture }}" alt="Highest Participation Event Image">
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
                            @if(isset($highestParticipationEvent))
                              <p style="white-space: nowrap;overflow: hidden;   text-overflow: ellipsis;">  {{ $highestParticipationEvent->description }}</p>
                            @else
                                <!-- Provide a default text or handle the case where no highest participation event is found -->
                                No information available.
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

                                <img src="{{ $event->event_picture }}" class="bd-placeholder-img card-img-top"
                                    width="100%" height="225" style="object-fit:scale-down;padding-top: 15px"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">

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
                            <p class="text-center">Opps, no relevant event found. Stay tune for new event updates!</p>
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

                                <img src="{{ $uc->event_picture }}" class="bd-placeholder-img card-img-top" width="100%"
                                    height="225" style="object-fit:scale-down;padding-top: 15px"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">

                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em"></text>
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
                            <p class="text-center">Opps, no relevant event found. Stay tune for new updates!</p>
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
