@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Featured Teachers</h6>
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
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Alternative Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers as $teacher)
                        @if ($teacher->verified && $teacher->is_featured && $teacher->active)
                            <tr>
                                <td><img src="{{ $teacher->imgpath ?? asset('/img/default-user.jpg')}}"
                                         style="width: 50px; height: 75px; object-fit: cover;"></td>
                                <td>{{ $teacher->user->name}}</td>
                                <td>{{ $teacher->user->phone}}</td>
                                <td>{{ $teacher->altphone}}</td>
                                <td>{{ $teacher->user->email}}</td>
                                <td>{{ $teacher->gender}}</td>
                                <td>
                                    <?php if ($teacher->active) {
                                        echo 'Active';
                                    } else {
                                        echo 'Inactive';
                                    } ?>
                                </td>
                                <td>{{ $teacher->city}}, {{ $teacher->state}}</td>
                                <td>
                                    <div class="row">
                                        <form action="/teacher-unfeature/{{ $teacher->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button type="submit" href="" class="btn btn-warning m-1">UnFeature</button>
                                        </form>
                                        <a href="/teacher-edit/{{ $teacher->id }}"
                                           class="btn btn-secondary m-1">Edit</a>
                                        <form action="/teacher-delete/{{ $teacher->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" href="" class="btn btn-danger m-1">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')
