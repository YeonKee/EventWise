@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)

@section('body')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    </style>

    <style>

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



    <section class="hero-section set-bg" data-setbg="/img/hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-text">
                        <span>5 to 9 may 2019, mardavall hotel, New York</span>
                        <h2>Change Your Mind<br /> To Become Sucess</h2>
                        <a href="#" class="primary-btn">Buy Ticket</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="/img/hero-right.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Counter Section Begin -->
    <section class="counter-section bm-gradient">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="counter-text">
                        <span>Conference Date</span>
                        <h3>Count Every Second <br />Until the Event</h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="cd-timer" id="countdown">
                        <div class="cd-item">
                            <span>40</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>46</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>32</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Home About Section Begin -->
    <section class="home-about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ha-pic">
                        <img src="/img/h-about.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ha-text">
                        <h2>About Conference</h2>
                        <p>When I first got into the online advertising business, I was looking for the magical
                            combination that would put my website into the top search engine rankings, catapult me to
                            the forefront of the minds or individuals looking to buy my product, and generally make me
                            rich beyond my wildest dreams! After succeeding in the business for this long, I’m able to
                            look back on my old self with this kind of thinking and shake my head.</p>
                        <ul>
                            <li><span class="icon_check"></span> Write On Your Business Card</li>
                            <li><span class="icon_check"></span> Advertising Outdoors</li>
                            <li><span class="icon_check"></span> Effective Advertising Pointers</li>
                            <li><span class="icon_check"></span> Kook 2 Directory Add Url Free</li>
                        </ul>
                        <a href="#" class="ha-btn">Discover Now</a>
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
                            <p class="text-center">Opps, no relevant event found. Stay tune for new updates!</p>
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



        @yield('foot')
        <!-- Contact Section Begin -->
        {{-- <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>Location</h2>
                        <p>Get directions to our event center</p>
                    </div>
                    <div class="cs-text">
                        <div class="ct-address">
                            <span>Address:</span>
                            <p>01 Pascale Springs Apt. 339, NY City <br />United State</p>
                        </div>
                        <ul>
                            <li>
                                <span>Phone:</span>
                                (+12)-345-67-8910
                            </li>
                            <li>
                                <span>Email:</span>
                                info.colorlib@gmail.com
                            </li>
                        </ul>
                        <div class="ct-links">
                            <span>Website:</span>
                            <p>https://conference.colorlib.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cs-map">
                        <iframe
                            src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=TARUMT&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            height="400" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
        <!-- Contact Section End -->


        {{-- <script>
        $(document).ready(function(){
            $(".buttonoverlapmulti").hide();
            $(".buttonoverlapmulti").hover(function(){
                $(this).show();
            });
        });
        </script> --}}

        <!-- Js Plugins -->
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.magnific-popup.min.js"></script>
        <script src="/js/jquery.countdown.min.js"></script>
        <script src="/js/jquery.slicknav.js"></script>
        <script src="/js/owl.carousel.min.js"></script>
        <script src="/js/main.js"></script>

    @endsection
