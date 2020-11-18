@include('student.partials.header')
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Suggested Coachings</h1>
    </div>
    
<div class="popular_courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                    @foreach ($coachings as $row)
                    <?php if ($row->verified && $row->active) { ?>
                        <div class="single_course">
                            <div class="course_head">
                                <img class="img-fluid" src="{{ $row->imgpath}}" style="height: 300px; object-fit: cover;" alt="" />
                            </div>
                            <div class="course_content">
                                <br>
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
                            <h6>
                                Director : {{ $row->directorname}}
                            </h6>
                            <h6>
                                Address : @if($row->address1 != $row->city) {{ $row->address1}}, @endif @if($row->address2) {{ $row->address2}}, @endif {{ $row->city}}, {{ $row->state}}
                            </h6>
                            <div class="col-12 text-center mt-4">
                                <a href="/coachingdetail/{{ $row->userid }}" class="btn btn-sm btn-primary p-2"><i class="fas fa-list fa-sm text-white-50"></i> &nbsp; Details</a>
                                <a href="" class="btn btn-sm btn-success p-2"><i class="fas fa-plus fa-sm text-white-50"></i> &nbsp; Join</a>
                            </div>
                        </div>
                        </div>
                    <?php } ?>
                    @endforeach
            </div>
        </div>
    </div>
</div>

</div>
</div>
@include('student.partials.footer')