@include('partials.header')
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="banner_content text-center">
                        <h2>Contact Us</h2>
                        <div class="page_link">
                            <a href="{{url('/')}}">Home</a>
                            <a href="{{url('/contact')}}">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Contact Area =================-->
<section class="contact_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="ti-home"></i>
                        <h6>Purnia</h6>
                        <p>Bihar - 854301</p>
                    </div>
                    <div class="info_item">
                        <i class="ti-headphone"></i>
                        <h6><a href="#">+91 91029 55721, <br> +91 7061091469</a></h6>
                        <p>Mon to Fri 9am to 6pm</p>
                    </div>
                    <div class="info_item">
                        <i class="ti-email"></i>
                        <h6><a href="#">teacher@ctaoi.com</a></h6>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <h2 class="mb-4">Get in Touch</h2>
                @if (session('status'))
                <div class="alert alert-success mt-2 ml-2 mr-2" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{url('/sendquery')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input id="name" type="text" value="{{ old('name') }}" placeholder="Enter Your Name" style="font-size: 12px;" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input id="phone" type="tel" pattern="^\d{10}$" value="{{ old('phone') }}" placeholder="Enter Your Mobile No." style="font-size: 12px;" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="phone" autofocus>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="email" type="email" value="{{ old('email') }}" placeholder="Enter Your Email Id" style="font-size: 12px;" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="subject" type="text" value="{{ old('subject') }}" placeholder="Enter Subject" style="font-size: 12px;" class="form-control @error('subject') is-invalid @enderror" name="subject" autocomplete="subject">

                            @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea id="message" placeholder="Enter Message" style="font-size: 12px;" class="form-control @error('message') is-invalid @enderror" name="message"></textarea>

                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn primary-btn">
                                SEND MESSAGE
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@include('partials.footer')