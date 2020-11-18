@include('student.partials.header')
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Dashboard</h1>
        <a href="{{ url('/editstudent') }}" class="btn btn-sm btn-primary m-2"><i class="m-2 fas fa-list fa-sm text-white-50"></i> Edit Details</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$user->name}} - {{$user->email}}</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{$data->imgpath}}" alt="">
            </div>
            <div class="row container">
                <p class="col-lg-6 col-md-12 col-sm-12">Level: &nbsp; {{$data->level}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Gender: &nbsp; {{$data->gender}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Phone: &nbsp; {{$user->phone}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Description: &nbsp; {{$data->description}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">City: &nbsp; {{$data->city}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">State: &nbsp; {{$data->state}}</p>
            </div>
        </div>
    </div>



</div>
</div>
@include('student.partials.footer')