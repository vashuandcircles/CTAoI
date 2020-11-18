@include('partials.header')

    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image text-center">
                        <img class="img-fluid" src="{{ $data->imgpath }}" alt="">
                    </div>
                    <div class="content_wrapper">
                        @if($data->description)
                        <h4 class="title">Objectives</h4>
                        <div class="content">
                            {{ $data->description }}
                        </div>
                        @endif

                        @if($data->eligibility)
                        <h4 class="title">Eligibility</h4>
                        <div class="content">
                            {{ $data->eligibility }}
                        </div>
                        @endif

                        <h4 class="title">Course Outline</h4>
                        <div class="content">
                            <ul class="course_list">
                                <li class="justify-content-between d-flex">
                                    @foreach($course as $row)
                                    <p>{{$row->course}} - {{$row->teacher}}</p>
                                    @endforeach
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Coaching Name</p>
                                <span class="or">{{ $user->name }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Director’s Name</p>
                                <span>{{ $data->directorname }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Level </p>
                                <span>{{ $data->level }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Email </p>
                                <span>{{ $user->email }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Specialization </p>
                                <span>{{ $data->specialization }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Phone </p>
                                <span> +91 {{ $user->phone }}</span>
                            </a>
                        </li>
                        @if($data->altphone)
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Alternative Phone </p>
                                <span>{{ $data->altphone }}</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>City & State</p>
                                <span>{{ $data->city }}, {{ $data->state }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Landmark </p>
                                <span>{{ $data->landmark }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Details Area =================-->
@include('partials.footer')