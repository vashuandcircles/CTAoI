  <!--================ Start footer Area  =================-->
  <footer class="footer-area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 single-footer-widget">
          <h4>Coaching Teachers Association of India</h4>
          <ul>
            <li><a>We connect our students with well trained and experienced team of Teachers and equipped
                 Coaching centers across the nation. We guarantee the improvement!</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 single-footer-widget">
          <h4>Contact Info</h4>
          <ul>
            <li><a>Address : Purnia, Bihar - 854301 <br>
            Phone : +91 7061091469 <br>
            Whatsapp : +91 9102955721 <br>
            Email : teacher@ctaoi.com</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 single-footer-widget">
          <h4>Newsletter</h4>
          <p>You can trust us. we only send promo offers,</p>
          <div class="form-wrap">
            <form method="POST"
              action="{{ url('/subscribe') }}"
              class="form-inline">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <input class="form-control" name="email" id="email" placeholder="Your Email Address" onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Your Email Address'" required="" type="email" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              <button type="submit" class="click-btn btn btn-default">
                <span>subscribe</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="row footer-bottom d-flex justify-content-between">
        <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
            <span> Copyright  &copy; 2020 CTAoI. All Rights Reserved. </span>
        </p>
        <div class="col-lg-4 col-sm-12 footer-social">
          <a href="#"><i class="ti-facebook"></i></a>
          <a href="#"><i class="ti-youtube"></i></a>
          <a href="#"><i class="ti-instagram"></i></a>
          <a href="#"><i class="ti-linkedin"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!--================ End footer Area  =================-->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/owl-carousel-thumb.min.js')}}"></script>
<script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('js/mail-script.js')}}"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="{{asset('js/gmaps.min.js')}}"></script>
<script src="{{asset('js/theme.js')}}"></script>
</body>

</html>
