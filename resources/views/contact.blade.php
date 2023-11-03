@extends('layoutFront')

@section('body')


    <!-- Contact Top Content Section Begin -->
    <section class="contact-content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cc-text set-bg" data-setbg="img/contact-content-bg.jpg">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-4">
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
            <div class="row">
                <div class="col-lg-12">
                    <form action="#" class="comment-form contact-form">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Email">
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Phone">
                            </div>
                            <div class="col-lg-12 text-center">
                                <textarea placeholder="Messages"></textarea>
                                <button type="submit" class="site-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

@endsection