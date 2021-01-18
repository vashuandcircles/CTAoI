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
                <table id="example" class="display" style="width:100%">
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
                    @foreach ($teachers as $key => $teacher)
                        <tr>
                            <td>
                                <img src="{{$teacher->imgpath ?? asset('/img/default-user.jpg')}}"
                                     class="rounded-circle" alt="img"
                                     style="width: 75px; height: 75px; object-fit: cover;">
                            </td>
                            <td>{{$teacher->user->name??''}}</td>
                            <td>{{$teacher->user->phone??''}}</td>
                            <td>{{$teacher->user->email??''}}</td>
                            <td>{{$teacher->gender??''}}</td>
                            <td>{{ $teacher->city}} @if($teacher->state != NULL) , @endif {{ $teacher->state}}</td>


                            <td>
                                <nobr>
                                    <div class="row"  style="    flex-wrap: initial;
">
                                        @if (!$teacher->is_featured)
                                            <form action="{{route('teachers.feature', $teacher->id) }}"
                                                  method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <button type="submit" href=""
                                                        class="btn btn-success btn-sm m-1"><i class="fa fa-user-plus"
                                                                                       title="  Feature"
                                                                                       aria-hidden="true"></i>

                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{route('teachers.edit', $teacher->id) }}"
                                           class="btn btn-sm btn-secondary m-1"><i class="fas fa-edit" title="  Edit"
                                            ></i>

                                        </a>

                                        <form action="{{route('teachers.destroy', $teacher->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" href="" class="btn btn-sm btn-danger m-1"
                                                    onclick="return confirm('Are you sure to delete this item?')"><i
                                                    class="fas fa-trash" title="  Delete"
                                                ></i>
                                            </button>
                                        </form>
                                    </div>
                                </nobr>
                            </td>
                        </tr>
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

