@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Teachers</h6>
                <a href="{{ route('teachers.create') }}" class="m-2 ml-auto btn btn-primary text-white">
                    Add Teacher
                </a>
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
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers as $key => $row)
                        <?php if ($row->verified) { ?>
                        <tr>
                            <td>
                                <img
                                    src="{{($row->imgpath ?? asset('/img/default-user.jpg'))}}"
                                    style="width: 50px; height: 75px; object-fit: cover;"></td>
                            <td>{{ $user[$key]->name }}</td>
                            <td>{{ $user[$key]->phone }} <br> {{ $row->altphone}} </td>
                            <td>{{ $user[$key]->email }}</td>
                            <td>{{ $row->gender}}</td>
                            <td>{{ $row->city}} @if($row->state != NULL) , @endif {{ $row->state}}</td>
                            <td>
                                <div class="row">
                                    <?php if (!$row->is_featured) { ?>
                                    <form action="{{route('teachers.feature', $row->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button type="submit" href="" class="btn btn-success m-1">Feature</button>
                                    </form>
                                    <?php } ?>
                                    <a href="{{route('teachers.edit', $row->id) }}"
                                       class="btn btn-secondary m-1">Edit</a>
                                    <form action="{{route('teachers.destroy', $row->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" href="" class="btn btn-danger m-1"
                                                onclick="return confirm('Are you sure to delete this item?')">Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $teachers->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')
