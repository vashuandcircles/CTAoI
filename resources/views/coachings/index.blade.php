@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Coachings</h6>
                <a href="{{ route('coachings.create') }}" class="m-2 ml-auto btn btn-primary text-white">
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
                    @foreach ($coachings as $key => $row)
                        @if ($row->verified && $row->active)
                            <tr>
                                <td><img src="{{ $row->imgpath}}" style="width: 50px; height: 75px; object-fit: cover;">
                                </td>
                                <td>{{ $user[$key]->name }}</td>
                                <td>{{ $row->directorname}}</td>
                                <td>{{ $user[$key]->phone }} <br> {{ $row->altphone}} </td>
                                <td>{{ $user[$key]->email }}</td>
                                <td>{{ $row->address1}} {{ $row->address2}}, {{ $row->state}}
                                    , {{ $row->city}} {{ $row->zipcode}}</td>
                                <td>
                                    <div class="row">
                                        @if (!$row->is_featured)
                                            <form action="{{route('coachings.feature', $row->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <button type="submit" href="" class="btn btn-success m-1">Feature
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('coachings.edit',$row->id) }}"
                                           class="btn btn-secondary m-1">Edit</a>
                                        <form action="{{ route('coachings.destroy',$row->id) }}" method="POST"
                                              onclick="return confirm('Are you sure to delete this item?')">
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
                <div class="d-flex justify-content-center">
                    {!! $coachings->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')
