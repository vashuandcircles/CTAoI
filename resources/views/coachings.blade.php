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
                @foreach ($coachings as $key => $row)
                    <?php if ($row->verified && $row->active) { ?>
                        <div class="single_course col-lg-4 col-sm-12 col-md-6 p-4" style="height: 750px;">
                            <div class="course_head text-center">
                                <img class="img-fluid" src="{{ $row->imgpath}}" style="height: 300px; object-fit: cover;" alt="" />
                            </div>
                            <div class="course_content" style="height: 325px; width: 100%;">
                            <h4 class="mb-3" style="height: 40px;">
                                <a>@if($row->is_featured) {{ $user[$key]->name }} @endif</a>
                            </h4>
                            <h6 style="height: 30px;">
                                Expert in : {{ $row['specialization'] }}
                            </h6>
                            <h6 style="height: 30px;">
                            <?php 
                            $newphone = $user[$key]->phone;
                            if(!$row->is_featured) {
                            $newphone = substr($newphone, 6);
                            $newphone = "******".$newphone;
                            }
                             ?>
                                Contact : {{ $newphone }}
                            </h6>
                            <h6 style="height: 30px; word-wrap: break-word;">
                            <?php 
                            $newemail = $user[$key]->email;
                            if(!$row->is_featured) {
                            $newemail = substr($newemail, 6);
                            $newemail = "******".$newemail;
                            }
                             ?>
                                Email : {{ $newemail }}
                            </h6>
                            <h6 style="height: 30px;">
                                Director : {{ $row->directorname}}
                            </h6>
                            <h6 style="height: 70px;">
                                Address : @if($row->address1 != $row->city) {{ $row->address1}}, @endif @if($row->address2) {{ $row->address2}}, @endif {{ $row->city}}, {{ $row->state}}
                            </h6>
                            @if($row->is_featured) 
                            <div class="col-12 text-center">
                                <a href="/coachingdetail/{{ $row->userid }}" class="mt-4 primary-btn ">Details</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <?php } ?>
                    @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {!! $coachings->links() !!}
        </div>
    </div>
</div>
@include('partials.footer')