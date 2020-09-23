@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Coachings</h6>
                <a href="{{ url('/addcoachingpage') }}" class="m-2 ml-auto btn btn-primary text-white">
                    Add Coaching
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
                            <th>Director's Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coachings as $row)
                        <?php if (!$row->verified) { ?>
                            <tr>
                                <td><img src="{{ $row->imgpath}}" style="width: 50px; height: 75px; object-fit: cover;"> </td>
                                <td>{{ $row->name}}</td>
                                <td>{{ $row->directorname}}</td>
                                <td>{{ $row->phone}} <br> {{ $row->altphone}} </td>
                                <td>{{ $row->email}}</td>
                                <td>{{ $row->address1}} {{ $row->address2}}, {{ $row->state}}, {{ $row->city}} {{ $row->zipcode}}</td>
                                <td>
                                <div class="row">
                                        <form action="/coaching-accept/{{ $row->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button type="submit" href="" class="btn btn-success m-1">Accept</button>
                                        </form>
                                        <form action="/coaching-delete/{{ $row->id }}" method="POST">
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