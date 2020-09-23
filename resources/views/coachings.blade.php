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
            @foreach ($coachings as $row)
            <?php if ($row->verified && $row->active) { ?>
                <div class="col-lg-3 mb-4">
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
                                Address : @if($row->address1 != $row->city) {{ $row->address1}},@endif @if($row->address2) {{ $row->address2}}, @endif {{ $row->city}}, {{ $row->state}}
                            </h6>
                        </div>
                    </div>
                <?php } ?>
                </div>
                @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {!! $coachings->links() !!}
        </div>
    </div>
</div>
@include('partials.footer')