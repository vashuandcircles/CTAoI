@foreach ($coachings as $key => $row)
    @if ($row->verified && $row->active)
        <div class="single_course col-lg-4 col-sm-12 col-md-6 p-4">
            <div class="course_head">
                <img class="img-fluid" src="{{ $row->imgpath}}" style="height: 300px; object-fit: cover;"
                     alt=""/>
            </div>
            <div class="course_content">
                <h4 class="mb-3">
                    <a>@if($row->is_featured) {{ $user[$key]->name }} @endif</a>
                </h4>
                <h6>
                    Expert in : {{ $row['specialization'] }}
                </h6>
                <h6>
                    <?php
                    $newphone = $user[$key]->phone;
                    if (!$row->is_featured) {
                        $newphone = substr($newphone, 6);
                        $newphone = "******" . $newphone;
                    }
                    ?>
                    Contact : {{ $newphone }}
                </h6>
                <h6 style="word-wrap: break-word;">
                    <?php
                    $newemail = $user[$key]->email;
                    if (!$row->is_featured) {
                        $newemail = substr($newemail, 6);
                        $newemail = "******" . $newemail;
                    }
                    ?>
                    Email : {{ $newemail }}
                </h6>
                <h6>
                    Director : {{ $row->directorname}}
                </h6>
                <h6>
                    Address : @if($row->address1 != $row->city) {{ $row->address1}}
                    , @endif @if($row->address2) {{ $row->address2}}, @endif {{ $row->city}}
                    , {{ $row->state}}
                </h6>
                @if($row->is_featured)
                    <div class="col-12 text-center">
                        <a href="/coachingdetail/{{ $row->userid }}" class="mt-4 primary-btn ">Details</a>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endforeach
