@include('partials.header')
<div class="popular_courses">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Our Popular Students</h2>
                    <p>
                        Replenish man have thing gathering lights yielding shall you
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
                    @foreach ($students as $student)
                        <div class="single_course col-lg-4 col-sm-12 col-md-6 p-4">
                            <div class="course_head text-center">
                                <img class="img-fluid" src="{{ $student->imgpath ?? asset('/img/default-user.jpg')}}" style="height: 300px;" alt="" />
                            </div>
                            <div class="course_content">
                                <h4 class="mb-4">
                                    <a>{{$student->user->name }}</a>
                                </h4>
                                <p>
                                    {{ $student->description}}
                                </p>
                                <br>
                                <h6>
                                    Contact : {{ $student->phone}}
                                </h6>
                                <h6 style="word-wrap: break-word;">
                                    Email : {{$student->user->email }}
                                </h6>
                                <h6>
                                    Address : {{ $student->city}}, {{ $student->state}}
                                </h6>
                                <div class="col-12 text-center">
                                    <a href="/studentdetail/{{ $student->id }}" class="mt-4 primary-btn ">Details</a>
                                </div>
                            </div>
                        </div>

                    @endforeach

        </div>
    </div>
</div>
@include('partials.footer')
