@include('partials.header')
<div class="popular_courses">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title" style="margin-top: 90px;">
                    <h2>Our Popular Teachers</h2>
                    <p>
                        Replenish man have thing gathering lights yielding shall you
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($teachers as $teacher)
                @if ($teacher->verified && $teacher->active)
                    <div class="single_course col-lg-4 col-sm-12 col-md-6 p-4">
                        <div class="course_head text-center">
                            <img class="img-fluid" src="{{ $teacher->imgpath ?? asset('/img/default-user.jpg')}}"
                                 style="height: 300px;" alt=""/>
                        </div>
                        <div class="course_content">
                            <h4 class="mb-4">
                                <a>{{ $teacher->user->name }}</a>
                            </h4>
                            <p>
                                {{ $teacher->description}}
                            </p>
                            <br>
                            <?php
                            $phone_number = $teacher->user->phone;
                            if (!$teacher->is_featured) {
                                $phone_number = substr($phone_number, 6);
                                $phone_number = "******" . $phone_number;
                            }
                            ?>
                            <h6>
                                Contact : {{$phone_number}}
                            </h6>
                            <?php
                            $email = $teacher->user->email;
                            if (!$teacher->is_featured) {
                                $email = substr($email, 6);
                                $email = "******" . $email;
                            }
                            ?>
                            <h6 style="word-wrap: break-word;">
                                Email : {{ $email }}
                            </h6>
                            <h6>
                                Expert in : {{ $teacher->specialization}}
                            </h6>
                            <h6>
                                Address : {{ $teacher->city}}, {{ $teacher->state}}
                            </h6>
                            @if($teacher->is_featured)

                            <div class="col-12 text-center">
                                <a href="/teacherdetail/{{ $teacher->id }}" class="mt-4 primary-btn ">Details</a>
                            </div>
                                @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {!! $teachers->links() !!}
        </div>
    </div>
</div>
@include('partials.footer')
