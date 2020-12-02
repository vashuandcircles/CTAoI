@include('coaching.partials.header')
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Coaching Dashboard</h1>
        <a href="{{ url('/editcoaching') }}" class="btn btn-sm btn-primary m-2"><i class="m-2 fas fa-list fa-sm text-white-50"></i> Edit Details</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="col-lg-6 col-md-12 col-sm-12 font-weight-bold text-primary">{{$user->name}} - {{$user->email}}</h6>
                <h6 class="col-lg-6 col-md-12 col-sm-12 font-weight-bold">Director's Name: {{$data->directorname}}</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{$data->imgpath}}" alt="">
            </div>
            <div class="row container">
                <p class="col-lg-6 col-md-12 col-sm-12">Level: &nbsp; {{$data->level}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Phone: &nbsp; {{$user->phone}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Alternative Phone: &nbsp; {{$data->altphone}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Specialization: &nbsp; {{$data->specialization}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Address 1: &nbsp; {{$data->address1}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Address 2: &nbsp; {{$data->address2}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Description: &nbsp; {{$data->description}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">Landmark: &nbsp; {{$data->landmark}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">City: &nbsp; {{$data->city}}</p>
                <p class="col-lg-6 col-md-12 col-sm-12">State: &nbsp; {{$data->state}}</p>
            </div>
        </div>
    </div>

</div>
</div>
@include('coaching.partials.footer')
