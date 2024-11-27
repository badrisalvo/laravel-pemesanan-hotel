<!-- Footer Area Start -->
<footer class="footer-area section-padding-80-0">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row align-items-baseline justify-content-between">
                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Footer Logo -->
                            <a href="#" class="footer-logo"><img src="{{ asset ('img/core-img/persamaan2.png') }}" alt=""></a>

                            <h4>+12 345-678-9999</h4>
                            <span>persamaan_hotel@gmail.com</span>
                            <span>Jl. Kp. Jawa Dalam IV No.4, Kp. Jao, Kec. Padang Bar., Kota Padang, Sumatera Barat 25112</span>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Our Blog</h5>

                            <!-- Single Blog Area -->
                            <div class="latest-blog-area">
                                <a href="#" class="post-title">Tour & Travel</a>
                                <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i> Jan 02, 2019</span>
                            </div>

                            <!-- Single Blog Area -->
                            <div class="latest-blog-area">
                                <a href="#" class="post-title">Tour Guide</a>
                                <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i> Jan 02, 2020</span>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-4 col-lg-2">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Links</h5>

                            <!-- Footer Nav -->
                            <ul class="footer-nav">
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> About Us</a></li>
                                <li><a href="/room"><i class="fa fa-caret-right" aria-hidden="true"></i> Our Room</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Career</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> FAQs</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-8 col-lg-4">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Subscribe Newsletter</h5>
                            <span>Subscribe our newsletter gor get notification about new updates.</span>

                            <!-- Newsletter Form -->
                            <form action="#" class="nl-form">
                                <input type="email" class="form-control" placeholder="">
                                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="container">
            <div class="copywrite-content">
                <div class="row align-items-center">
                    <div class="col-12 col-md-8">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                    <div class="social-info">
                        @if($abouts && $abouts->isNotEmpty())
                            @if ($instagram = $abouts->where('title', 'Instagram')->first())
                                <a href="{{ $instagram->description }}" target="_blank">
                                    <i class="fa fa-instagram" aria-hidden="true"></i> Instagram
                                </a>
                            @endif

                            <!-- Facebook -->
                            @if ($facebook = $abouts->where('title', 'Facebook')->first())
                                <a href="{{ $facebook->description }}" target="_blank">
                                    <i class="fa fa-facebook" aria-hidden="true"></i> Facebook
                                </a>
                            @endif

                            <!-- Twitter -->
                            @if ($twitter = $abouts->where('title', 'Twitter')->first())
                                <a href="{{ $twitter->description }}" target="_blank">
                                    <i class="fa fa-twitter" aria-hidden="true"></i> Twitter
                                </a>
                            @endif

                            @if ($youtube = $abouts->where('title', 'YouTube')->first())
                                <a href="{{ $youtube->description }}" target="_blank">
                                    <i class="fa fa-youtube" aria-hidden="true"></i> YouTube
                                </a>
                            @endif
                        @else
                            <p>No social media links available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </footer>