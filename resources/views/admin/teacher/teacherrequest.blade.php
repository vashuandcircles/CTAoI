@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Teachers Request</h6>
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
                            <th>Specialization</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $key => $row)
                        <?php if (!$row->verified  && $row->active) { ?>
                            <tr>
                                <td><img src="{{ $row->imgpath ?? asset('/img/default-user.jpg')}}" style="width: 50px; height: 75px; object-fit: cover;"> </td>
                                <td>{{ $user[$key]->name }}</td>
                                <td>{{ $user[$key]->phone }}, {{ $row->altphone}}</td>
                                <td>{{ $user[$key]->email }}</td>
                                <td>{{ $row->specialization}}</td>
                                <td>{{ $row->gender}}</td>
                                <td>{{ $row->city}}, {{ $row->state}}</td>
                                <td>{{ $row->description}}</td>
                                <td>
                                    <div class="row">
                                        <form action="/teacher-accept/{{ $row->userid }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button type="submit" href="" class="btn btn-success m-1">Accept</button>
                                        </form>
                                        <form action="/teacher-delete/{{ $row->userid }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" href="" class="btn btn-danger m-1">Decline</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')
