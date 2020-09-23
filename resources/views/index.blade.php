@include('partials.header')
@if (session('status'))
<div class="alert alert-success mt-2 ml-2 mr-2" role="alert">
    {{ session('status') }}
</div>
@endif
<section class="home_banner_area">
    <div class="banner_inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_content text-center">
                        <p class="text-uppercase">
                            Connecting Students and Teachers
                        </p>
                        <h2 class="text-uppercase mt-4 mb-5">
                            Coaching Teachers Association of India
                        </h2>
                        <div>
                            <a href="{{url('/registercoaching')}}" class="primary-btn2 mb-3 mb-sm-0">Coaching registration</a>
                            <a href="{{url('/registerteacher')}}" class="primary-btn ml-sm-3 ml-0">Tutor Signup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Home Banner Area =================-->

<!--================ Start Feature Area =================-->
<section class="feature_area section_gap_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Features</h2>
                    <p>
                    An investment in knowledge pays the best interest
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-earth"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">As an Institution</h4>
                        <p>
                        You will find the large set of teachers and students on single platform.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-book"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">As a Teacher</h4>
                        <p>
                        You we get chance to connect with students and institutions.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-student"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">As a Student</h4>
                        <p>
                        You will have wide range of options to choose from teachers and institutions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-student"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">Scholarship Facility</h4>
                        <p>
                            One make creepeth, man bearing theira firmament won't great
                            heaven
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-earth"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">Sell Online Course</h4>
                        <p>
                            One make creepeth, man bearing theira firmament won't great
                            heaven
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single_feature">
                    <div class="icon"><span class="flaticon-book"></span></div>
                    <div class="desc">
                        <h4 class="mt-3 mb-2">Global Certification</h4>
                        <p>
                            One make creepeth, man bearing theira firmament won't great
                            heaven
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Feature Area =================-->

<!--================ Start Popular Courses Area =================-->
<div class="popular_courses">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Our Popular Coachings</h2>
                    <p>
                    The roots of education are bitter, but the fruit is sweet
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel active_course">
                    @foreach ($coachings as $row)
                    <?php if ($row->verified && $row->active && $row->is_featured) { ?>
                        <div class="single_course">
                            <div class="course_head">
                                <img class="img-fluid" src="{{ $row->imgpath}}" style="height: 300px; object-fit: cover;" alt="" />
                            </div>
                            <div class="course_content">
                            <h4 class="mb-3">
                                <a>{{ $row->name}}</a>
                            </h4>
                            <h6>
                                Expert in : {{ $row->specialization}}
                            </h6>
                            @if($row->level)
                            <h6>
                                Level : {{ $row->level}}
                            </h6>
                            @endif
                            <h6>
                                Contact : {{ $row->phone}}
                            </h6>
                            <h6 style="word-wrap: break-word;">
                                Email : {{ $row->email}}
                            </h6>
                            <h6>
                                Director : {{ $row->directorname}}
                            </h6>
                            <h6>
                                Address : @if($row->address1 != $row->city) {{ $row->address1}}, @endif @if($row->address2) {{ $row->address2}}, @endif {{ $row->city}}, {{ $row->state}}
                            </h6>
                        </div>
                        </div>
                    <?php } ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--================ End Popular Courses Area =================-->

<!--================ Start Popular Courses Area =================-->
<div class="popular_courses">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Our Popular Teachers</h2>
                    <p>
                    Live as if you were to die tomorrow. Learn as if you were to live forever
                    </p>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="owl-carousel active_course">

                    @foreach ($teachers as $row)
                    <?php if ($row->verified && $row->active && $row->is_featured) { ?>
                        <div class="single_course">
                            <div class="course_head">
                                <img class="img-fluid" src="{{ $row->imgpath}}" style="height: 300px; object-fit: cover;" alt="" />
                            </div>
                            <div class="course_content">
                                <h4 class="mb-4">
                                    <a href="course-details.html">{{ $row->firstname}} {{ $row->lastname}}</a>
                                </h4>
                                <p>
                                    {{ $row->description}}
                                </p>
                                <br>
                                <h6>
                                    Contact : {{ $row->phone}}
                                </h6>
                                <h6>
                                    Email : {{ $row->email}}
                                </h6>
                                <h6>
                                    Expert in : {{ $row->specialization}}
                                </h6>
                                <h6>
                                    Address : {{ $row->city}}, {{ $row->state}}
                                </h6>
                            </div>
                        </div>
                    <?php } ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--================ End Popular Courses Area =================-->

<!--================ Start Registration Area =================-->
<!-- <div class="section_gap registration_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1 class="mb-3">Register Your Coaching</h1>
                        <p>
                            There is a moment in the life of any aspiring astronomer that
                            it is time to buy that first telescope. It’s exciting to think
                            about setting up your own viewing station.
                        </p>
                    </div>
                    <div class="col clockinner1 clockinner">
                        <h1 class="days">150</h1>
                        <span class="smalltext">Days</span>
                    </div>
                    <div class="col clockinner clockinner1">
                        <h1 class="hours">23</h1>
                        <span class="smalltext">Hours</span>
                    </div>
                    <div class="col clockinner clockinner1">
                        <h1 class="minutes">47</h1>
                        <span class="smalltext">Mins</span>
                    </div>
                    <div class="col clockinner clockinner1">
                        <h1 class="seconds">59</h1>
                        <span class="smalltext">Secs</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="register_form">
                    <h3>Courses for Free</h3>
                    <p>It is high time for learning</p>
                    <form class="form_area" id="myForm" action="mail.html" method="post">
                        <div class="row">
                            <div class="col-lg-12 form_group">
                                <input name="name" placeholder="Your Name" required="" type="text" />
                                <input name="name" placeholder="Your Phone Number" required="" type="tel" />
                                <input name="email" placeholder="Your Email Address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required="" type="email" />
                            </div>
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!--================ End Registration Area =================-->

<!--================ Start Trainers Area =================-->
<!-- <section class="trainer_area section_gap_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Our Expert Trainers</h2>
                    <p>
                        Replenish man have thing gathering lights yielding shall you
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                <div class="thumb d-flex justify-content-sm-center">
                    <img class="img-fluid" src="img/trainer/t1.jpg" alt="" />
                </div>
                <div class="meta-text text-sm-center">
                    <h4>Mated Nithan</h4>
                    <p class="designation">Sr. web designer</p>
                    <div class="mb-4">
                        <p>
                            If you are looking at blank cassettes on the web, you may be
                            very confused at the.
                        </p>
                    </div>
                    <div class="align-items-center justify-content-center d-flex">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                <div class="thumb d-flex justify-content-sm-center">
                    <img class="img-fluid" src="img/trainer/t2.jpg" alt="" />
                </div>
                <div class="meta-text text-sm-center">
                    <h4>David Cameron</h4>
                    <p class="designation">Sr. web designer</p>
                    <div class="mb-4">
                        <p>
                            If you are looking at blank cassettes on the web, you may be
                            very confused at the.
                        </p>
                    </div>
                    <div class="align-items-center justify-content-center d-flex">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                <div class="thumb d-flex justify-content-sm-center">
                    <img class="img-fluid" src="img/trainer/t3.jpg" alt="" />
                </div>
                <div class="meta-text text-sm-center">
                    <h4>Jain Redmel</h4>
                    <p class="designation">Sr. Faculty Data Science</p>
                    <div class="mb-4">
                        <p>
                            If you are looking at blank cassettes on the web, you may be
                            very confused at the.
                        </p>
                    </div>
                    <div class="align-items-center justify-content-center d-flex">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                <div class="thumb d-flex justify-content-sm-center">
                    <img class="img-fluid" src="img/trainer/t4.jpg" alt="" />
                </div>
                <div class="meta-text text-sm-center">
                    <h4>Nathan Macken</h4>
                    <p class="designation">Sr. web designer</p>
                    <div class="mb-4">
                        <p>
                            If you are looking at blank cassettes on the web, you may be
                            very confused at the.
                        </p>
                    </div>
                    <div class="align-items-center justify-content-center d-flex">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--================ End Trainers Area =================-->

<!-- ================ Start Events Area ================= -->
<div class="events_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3 text-white">Features</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="single_event position-relative">
                    <div class="event_thumb">
                        <img src="img/event/e1.jpg" alt="" />
                    </div>
                    <div class="event_details">
                        <div class="d-flex mb-4">
                            <div class="date"><span>15</span> Oct</div>

                            <div class="time-location">
                                <p>
                                    <span class="ti-time mr-2"></span> 12:00 AM - 12:30 AM
                                </p>
                                <p>
                                    <span class="ti-location-pin mr-2"></span> Purnia
                                </p>
                            </div>
                        </div>
                        <p>
                            One make creepeth man for so bearing their firmament won't
                            fowl meat over seas great
                        </p>
                        <a href="#" class="primary-btn rounded-0 mt-3">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_event position-relative">
                    <div class="event_thumb">
                        <img src="img/event/e2.jpg" alt="" />
                    </div>
                    <div class="event_details">
                        <div class="d-flex mb-4">
                            <div class="date"><span>25</span> Oct</div>

                            <div class="time-location">
                                <p>
                                    <span class="ti-time mr-2"></span> 12:00 AM - 12:30 AM
                                </p>
                                <p>
                                    <span class="ti-location-pin mr-2"></span> Bangalore
                                </p>
                            </div>
                        </div>
                        <p>
                            One make creepeth man for so bearing their firmament won't
                            fowl meat over seas great
                        </p>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-12">
                <div class="text-center pt-lg-5 pt-3">
                    <a href="#" class="event-link">
                        View All Event <img src="img/next.png" alt="" />
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!--================ End Events Area =================-->

<!--================ Start Testimonial Area =================-->
<!-- <div class="testimonial_area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Client say about me</h2>
                    <p>
                        Replenish man have thing gathering lights yielding shall you
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="testi_slider owl-carousel">
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <img src="img/testimonials/t1.jpg" alt="" />
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Elite Martin</h4>
                                <p>
                                    Him, made can't called over won't there on divide there
                                    male fish beast own his day third seed sixth seas unto.
                                    Saw from
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <img src="img/testimonials/t2.jpg" alt="" />
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Davil Saden</h4>
                                <p>
                                    Him, made can't called over won't there on divide there
                                    male fish beast own his day third seed sixth seas unto.
                                    Saw from
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <img src="img/testimonials/t1.jpg" alt="" />
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Elite Martin</h4>
                                <p>
                                    Him, made can't called over won't there on divide there
                                    male fish beast own his day third seed sixth seas unto.
                                    Saw from
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <img src="img/testimonials/t2.jpg" alt="" />
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Davil Saden</h4>
                                <p>
                                    Him, made can't called over won't there on divide there
                                    male fish beast own his day third seed sixth seas unto.
                                    Saw from
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <img src="img/testimonials/t1.jpg" alt="" />
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Elite Martin</h4>
                                <p>
                                    Him, made can't called over won't there on divide there
                                    male fish beast own his day third seed sixth seas unto.
                                    Saw from
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testi_item">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <img src="img/testimonials/t2.jpg" alt="" />
                        </div>
                        <div class="col-lg-8">
                            <div class="testi_text">
                                <h4>Davil Saden</h4>
                                <p>
                                    Him, made can't called over won't there on divide there
                                    male fish beast own his day third seed sixth seas unto.
                                    Saw from
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
@include('partials.footer')