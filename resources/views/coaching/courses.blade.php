@include('coaching.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Courses Offered</h6>
            </div>
        </div>
        @if (session('status'))
        <div class="alert alert-success mt-2 ml-2 mr-2" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Teacher</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $row => $course)
                        <tr>
                            <td>{{ $row+1 }}</td>
                            <td>{{ $course['course']}}</td>
                            <td>{{ $course['teacher']}}</td>
                            <td>
                                <div class="row">
                                    <form action="/deletecourse/{{ $course->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" href="" class="btn btn-danger m-1">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Course</div>
                <div class="card-body">
                    <form method="POST" action="{{url('/addcourse')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        <div class="form-group row">
                            <label for="course" class="col-md-4 col-form-label text-md-right">Course Name</label>
                            <div class="col-md-6">
                                <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" value="{{ old('course') }}" name="course" autocomplete="course" autofocus>
                                @error('course')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="teacher" class="col-md-4 col-form-label text-md-right">Teacher Name</label>
                            <div class="col-md-6">
                                <input id="teacher" type="text" class="form-control @error('teacher') is-invalid @enderror" value="{{ $user->name }}" name="teacher" autocomplete="teacher" autofocus>
                                @error('teacher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('coaching.partials.footer')
