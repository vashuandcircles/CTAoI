{{--@isset($type)--}}
@include($type.'.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4" style="background-color: black">
        <div class="card-header py-3">
            <div class="row">
                <h3 class="m-3 font-weight-bold text-primary">Introduction to create zoom meeting credentials </h3>
                <a href="javascript:window.history.go(-1)" class="m-2 ml-auto btn btn-primary text-white flo">
                    Back to credentials
                </a>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success mt-2 ml-2 mr-2" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-body" style="background-color: #f3e3ff">
            <div class="col-md-8">

                <h4>Build an Zoom Application
                </h4>
                <ol>
                    <li>
                        Access <a target="_blank" href="https://marketplace.zoom.us/">Zoom marketplace</a>
                    </li>
                    <li>
                        Sign in
                    </li>
                    <li>
                        Click <i>Develop</i> button on header and select <i>Build App</i> menu.
                    </li>
                    <li>
                        Choose the JWT and create application with the app name what you want.
                    </li>
                    <li>
                        Input required information and click Continue until your app will be activated. Don't forget to
                        remember your credentials. It's used for API calling.
                    </li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel active_course">
                        <div class="course_head">
                            <img class="img-fluid"
                                 src="{{asset('img/zoom-file/cr1.png')}}" alt="intro 1">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="col-lg-12">
                <div class="owl-carousel active_course">
                    <div class="course_head">
                        <img class="img-fluid"
                             src="{{asset('img/zoom-file/cr2.png')}}" alt="intro 1">
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="col-lg-12">
                <div class="owl-carousel active_course">
                    <div class="course_head">
                        <img class="img-fluid"
                             src="{{asset('img/zoom-file/cr3.png')}}" alt="intro 1">
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="col-lg-12">
                <div class="owl-carousel active_course">
                    <div class="course_head">
                        <img class="img-fluid"
                             src="{{asset('img/zoom-file/cr4.png')}}" alt="intro 1">
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="col-lg-12">
                <div class="owl-carousel active_course">
                    <div class="course_head">
                        <img class="img-fluid"
                             src="{{asset('img/zoom-file/cr5.png')}}" alt="intro 1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.noConflict();

        $('#example').DataTable();
    });
</script>
@include($type.'.partials.footer')

