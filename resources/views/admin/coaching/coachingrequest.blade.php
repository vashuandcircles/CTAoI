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
                <table id="example" class="display" style="width:100%">
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
                        <?php if (!$row->verified) { ?>
                        <tr>
                            <td>
                                <img src="{{$row->imgpath ?? asset('/img/default-user.jpg')}}"
                                     class="rounded-circle" alt="img"
                                     style="width: 75px; height: 75px; object-fit: cover;">

                            </td>
                            <td>{{ $user[$key]->name }}</td>
                            <td>{{ $row->directorname}}</td>
                            <td>{{ $user[$key]->phone }} <br> {{ $row->altphone}} </td>
                            <td>{{ $user[$key]->email }}</td>
                            <td>{{ $row->address1}} {{ $row->address2}}, {{ $row->state}}
                                , {{ $row->city}} {{ $row->zipcode}}</td>
                            <td>
                                <div class="row">
                                    <form action="/coaching-accept/{{ $row->userid }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button type="submit" href="" class="btn btn-sm btn-success m-1"><i
                                                class="fas fa-check" title="  Accept"></i>
                                        </button>
                                    </form>
                                    <form action="/coaching-delete/{{ $row->userid }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" href="" class="btn btn-sm btn-danger m-1"><i
                                                class="fas fa-times" title="  Decline"></i>
                                        </button>
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
<script>
    $(document).ready(function () {
        $.noConflict();
        $('#example').DataTable();
    });
</script>
@include('admin.partials.footer')
