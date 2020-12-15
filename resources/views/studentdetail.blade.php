@include('partials.header')

    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_gap">
        <div class="container">
            <a href="{{url('/students')}}" class="primary-btn mb-3">
                <i class="fa fa-arrow-left" aria-hidden="true"> </i> &nbsp; Back</a>
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image text-center">
                        <img class="img-fluid" src="{{ $student->imgpath?? asset('/img/default-user.jpg') }}" alt="">
                    </div>
                    <div class="content_wrapper">
                        @if($student->description)
                        <h4 class="title">Objectives</h4>
                        <div class="content">
                            {{ $student->description }}
                        </div>
                        @endif

                        @if($student->eligibility)
                        <h4 class="title">Eligibility</h4>
                        <div class="content">
                            {{ $student->eligibility }}
                        </div>
                        @endif

                        <h4 class="title">Course Outline</h4>
                        <div class="content">
                            <ul class="course_list">
                                <li class="justify-content-between d-flex">
                                    <p>{{$student->user->course->course??''}} - {{$student->user->course->teacher??''}}</p>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <span style="text-align: center;" class="or">{{ $student->user->name }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Email</p>
                                <span style="text-align: right;">{{ $student->user->email }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Level </p>
                                <span style="text-align: right;">{{ $student->level }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Gender</p>
                                <span style="text-align: right;">{{ $student->gender }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Phone </p>
                                <span style="text-align: right;">{{ $student->user->phone }}</span>
                            </a>
                        </li>
                        @if($student->altphone)
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Alternative Phone </p>
                                <span style="text-align: right;">{{ $student->altphone }}</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>City</p>
                                <span style="text-align: right;">{{ $student->city }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>State</p>
                                <span style="text-align: right;">{{ $student->state }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Details Area =================-->
@include('partials.footer')
