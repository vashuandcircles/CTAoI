@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Coaching</h6>
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
                    @foreach ($coachings as $key => $coaching)
                        @if ($coaching->verified && $coaching->active)
                            <tr>
                                <td>
                                    <img src="{{$coaching->imgpath ?? asset('/img/default-user.jpg')}}"
                                         class="rounded-circle" alt="img"
                                         style="width: 75px; height: 75px; object-fit: cover;">
                                </td>
                                <td>{{ $coaching->user->name??'' }}</td>
                                <td>{{ $coaching->directorname??""}}</td>
                                <td>{{ $coaching->user->phone??"" }} <br> {{ $coaching->altphone}} </td>
                                <td>{{ $coaching->user->email??"" }}</td>
                                <td>{{ $coaching->address1??""}} {{ $coaching->address2??''}}, {{ $coaching->state??''}}
                                    , {{ $coaching->city??''}} {{ $coaching->zipcode??''}}</td>
                                <td>
                                    <div class="row" style="    flex-wrap: initial;
">
                                        @if (!$coaching->is_featured)
                                            <form action="{{route('coachings.feature', $coaching->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <button type="submit" href="" class="btn btn-sm btn-success m-1"><i
                                                        class="fa fa-user-plus"
                                                        title="  Feature"
                                                        aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('coachings.edit',$coaching->id) }}"
                                           class="btn btn-sm btn-secondary m-1"><i class="fas  fa-edit" title="  Edit"
                                            ></i></a>
                                        <form action="{{ route('coachings.destroy',$coaching->id) }}" method="POST"
                                              onclick="return confirm('Are you sure to delete this item?')">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" href="" class="btn btn-sm btn-danger m-1"><i
                                                    class="fas fa-trash" title="  Delete"
                                                ></i></button>
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
<script>
    $(document).ready(function () {
        $.noConflict();
        $('#example').DataTable();
    });
</script>
@include('admin.partials.footer')

