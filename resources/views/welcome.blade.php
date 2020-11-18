@include('partials.header')
@if (session('status'))
        <div class="alert alert-success mt-2 ml-2 mr-2" role="alert">
            {{ session('status') }}
        </div>
@endif
<section class="home_banner_area" style="background: url(../img/banner/welcome.png) no-repeat center; background-size: cover;">
    <div class="banner_inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_content text-center">
                        <h2 class="text-light mt-4 mb-5">
                            WELCOME TO CTAoI
                        </h2>
                        <p class="text-light text-uppercase">
                            Enjoy Your Premium Trial for 30 Days! &nbsp; &nbsp; <a class="text-light" href="{{ url('/login') }}">Login Here</a> <br> <br>
                        </p>
                        <h4 class="text-light text-uppercase">
                            You just got a wholesome free trial validity worth 300 Rs.
                        </h4>
                        <h4 class="text-light text-uppercase">
                        Having trouble? <a class="text-light" href="{{ url('/contact') }}"> Contact us</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.footer')