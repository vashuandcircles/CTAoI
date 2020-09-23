<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 single-footer-widget">
                <h4>Coaching Teachers Association of India</h4>
                <ul>
                    <li class="text-center"><a href="#">We connect our students with well trained and experienced team of Teachers and equipped Coaching centers across the nation. We guarantee the improvement!!</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 single-footer-widget">
                <h4>Newsletter</h4>
                <p class="text-center">You can trust us. we only send promo offers,</p>
                <form action="{{ url('/subscribe') }}" method="POST" class="form-inline" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group row">
                        <div class="col-md-12 text-center">
                            <input id="subemail" type="subemail" placeholder="Enter Your Email" class="form-control @error('subemail') is-invalid @enderror" name="subemail" autocomplete="subemail">
                            @error('subemail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="click-btn btn btn-primary">
                                SUBSCRIBE
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 col-md-6 single-footer-widget">
                <h4>Contact us</h4>
                <div class="contact_info text-center">
                    <p><span> Address :</span> Purnia, Bihar - 854301 </p>
                    <p><span> Phone :</span> +91 7061091469</p>
                    <p><span> Whatsapp :</span> +91 9102955721</p>
                    <p><span> Email : </span>teacher@ctaoi.com </p>
                </div>
            </div>
            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-12 col-sm-12 footer-text m-0 text-white">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This website is created and managed with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://andcircles.com" target="_blank">&Circles</a>
                </p>
                <!-- <div class="col-lg-2 col-sm-12 footer-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter"></i></a>
                    <a href="#"><i class="ti-instagram"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                </div> -->
            </div>
        </div>
</footer>
<!--================ End footer Area  =================-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="js/owl-carousel-thumb.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/mail-script.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="js/gmaps.min.js"></script>
<script src="js/theme.js"></script>
</body>

</html>