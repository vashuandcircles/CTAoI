@include('partials.header')

<!--================ Start Course Details Area =================-->
<section class="course_details_area section_gap">
    <div class="container">
        <a href="{{url('/teachers')}}" class="primary-btn mb-3">
            <i class="fa fa-arrow-left" aria-hidden="true"> </i> &nbsp; Back</a>
        <div class="row">
            <div class="col-lg-8 course_details_left">
                <div class="main_image text-center">
                    <img class="img-fluid" src="{{ $data->imgpath ?? asset('/img/default-user.jpg') }}" alt="">
                </div>
                <div class="content_wrapper">
                    @if(isset($data->description))
                        <h4 class="title">Objectives</h4>
                        <div class="content">
                            {{ $data->description }}
                        </div>
                    @endif

                    @if(isset($data->eligibility))
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
                            <span style="text-align: center;" class="or">{{ $data->user->name??'' }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="">
                            <p>Gender</p>
                            <span style="text-align: right;">{{ $data->gender??'' }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="">
                            <p>Level </p>
                            <span style="text-align: right;">{{ $data->level??'' }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="">
                            <p>Specialization </p>
                            <span style="text-align: right;">{{ $data->specialization??'' }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="">
                            <p>Phone </p>
                            <span style="text-align: right;">{{ $data->user->phone??'' }}</span>
                        </a>
                    </li>
                    @if(isset($data->altphone))
                        <li>
                            <a class="justify-content-between d-flex" href="">
                                <p>Alternative Phone </p>
                                <span style="text-align: right;">{{ $data->altphone??'' }}</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="justify-content-between d-flex" href="">
                            <p>City</p>
                            <span style="text-align: right;">{{ $data->city??'' }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="">
                            <p>State</p>
                            <span style="text-align: right;">{{ $data->state??'' }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--================ End Course Details Area =================-->
@include('partials.footer')
