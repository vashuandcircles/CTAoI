@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Featured Coachings</h6>
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
                            <th>Director's Name</th>
                            <th>Phone</th>
                            <th>Alternative Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coachings as $row)
                        <?php if ($row->verified && $row->is_featured && $row->active) { ?>
                            <tr>
                                <td><img src="{{ $row->imgpath ?? asset('/img/default-user.jpg')}}" style="width: 50px; height: 75px; object-fit: cover;"> </td>
                                <td>{{ $row->name}}</td>
                                <td>{{ $row->directorname}}</td>
                                <td>{{ $row->phone}}</td>
                                <td>{{ $row->altphone}}</td>
                                <td>{{ $row->email}}</td>
                                <td>
                                    <?php if ($row->active) {
                                        echo 'Active';
                                    } else {
                                        echo 'Inactive';
                                    } ?>
                                </td>
                                <td>{{ $row->address1}} {{ $row->address2}}, {{ $row->city}}, {{ $row->zipcode}}</td>
                                <td>
                                    <div class="row">
                                        <form action="/coaching-unfeature/{{ $row->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button type="submit" href="" class="btn btn-warning m-1">UnFeature</button>
                                        </form>
                                        <a href="/coaching-edit/{{ $row->id }}" class="btn btn-secondary m-1">Edit</a>
                                        <form action="/coaching-delete/{{ $row->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" href="" class="btn btn-danger m-1">Delete</button>
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
