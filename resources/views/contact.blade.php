@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)

@section('body')
    <!-- Contact Top Content Section Begin -->
    <section class="contact-content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cc-text set-bg" style="opacity: 1" data-setbg="img/contact-content-bg.jpg">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-4">
                                <div class="section-title">
                                    <h2>Location</h2>
                                    <p>Get directions to the college!</p>
                                </div>
                                <div class="cs-text">
                                    <div class="ct-address">
                                        <span>Address:</span>
                                        <p>Jalan Genting Kelang, Setapak, 53300 <br />Kuala Lumpur</p>
                                    </div>
                                    <ul>
                                        <li>
                                            <span>Phone:</span>
                                            (6)03-41450123
                                        </li>
                                        <li>
                                            <span>Email:</span>
                                            info@tarc.edu.my
                                        </li>
                                    </ul>
                                    <div class="ct-links">
                                        <span>Website:</span>
                                        <p>https://www.tarc.edu.my/</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cc-map">
                        <iframe
                            src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=TARUMT&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                            height="600" style="border:0;" allowfullscreen=""></iframe>
                        <div class="map-hover">
                            <i class="fa fa-map-marker"></i>
                            <div class="map-hover-inner">
                                <h5>Tunku Abdul Rahman University of Management and Technology (TAR UMT)</h5>
                                <p>Setapak, Kuala Lumpur, Malaysia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Top Content Section End -->

    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Contact Us By Email!</h2>
                        <p>Fill out the form below to recieve a free and confidential intial consultation.</p>
                    </div>
                </div>
            </div>
            <form method="POST" action="/contactByEmail" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row" style="margin-left:40px; ">
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" placeholder="Name"  value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone"placeholder="Phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-lg-12 text-center">
                                <textarea name="messages" id="messages" placeholder="Messages" style="resize:none;width: 600px;height: 300px;margin-left: 45px;margin-top: 20px;margin-bottom: 20px;">{{ old('messages') }}</textarea>
                                @error('messages')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    <br>
                                @enderror
                                <button type="submit" class="site-btn">Send Message</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Contact Form Section End -->

    <script>
        document.getElementById('contact').classList.add('active');
    </script>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
@endsection
