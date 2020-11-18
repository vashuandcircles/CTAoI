@include('partials.header')
<div class="popular_courses">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Our Popular Coachings</h2>
                    <p>
                        Replenish man have thing gathering lights yielding shall you
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
                    @foreach ($teachers as $key => $row)
                    <?php if ($row->verified && $row->active) { ?>
                        <div class="single_course col-lg-4 col-sm-12 col-md-6 p-4">
                            <div class="course_head">
                                <img class="img-fluid" src="{{ $row->imgpath}}" style="height: 300px; object-fit: cover;" alt="" />
                            </div>
                            <div class="course_content">
                                <h4 class="mb-4">
                                    <a>{{ $teacheruser[$key]->name }}</a>
                                </h4>
                                <p>
                                    {{ $row->description}}
                                </p>
                                <br>
                                <h6>
                                    Contact : {{ $row->phone}}
                                </h6>
                                <h6 style="word-wrap: break-word;">
                                    Email : {{ $teacheruser[$key]->email }}
                                </h6>
                                <h6>
                                    Expert in : {{ $row->specialization}}
                                </h6>
                                <h6>
                                    Address : {{ $row->city}}, {{ $row->state}}
                                </h6>
                                <div class="col-12 text-center">
                                    <a href="/teacherdetail/{{ $row->userid }}" class="mt-4 primary-btn ">Details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {!! $teachers->links() !!}
        </div>
    </div>
</div>
@include('partials.footer')