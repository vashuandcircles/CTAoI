@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Students</h6>
                <a href="{{ route('students.create') }}" class="m-2 ml-auto btn btn-primary text-white">
                    Add Student
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
                {{--                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">--}}
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
{{--                        <th>Email</th>--}}
                        {{--                        <th>Gender</th>--}}
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $key => $student)
                        <tr>
                            <td>
                                <img src="{{$student->imgpath ?? asset('/img/default-user.jpg')}}"
                                     class="rounded-circle" alt="img"
                                     style="width: 75px; height: 75px; object-fit: cover;">

                            </td>
                            <td>{{$student->user->name??''}}</td>
                            <td>{{$student->user->phone??''}}</td>
                            <td>{{$student->user->email??''}}</td>
                            {{--                            <td>{{$student->gender??''}}</td>--}}
                            @if($student->active ==1 )
                                   <td class=" btn btn-info btn-sm mt-4 badge"> <span>Active</span></td>
                            @else
                                <span>
                                   <td class=" btn btn-danger btn-sm mt-4">In Active</td>
                               </span>
                            @endif

                            <td>
                                <div class="row"  style="    flex-wrap: initial;
">
                                    <a href="{{route('students.edit', $student->id) }}"
                                       class="btn btn-sm btn-secondary m-1"><i class="fas  fa-edit" title="  Edit"
                                        ></i></a>
                                    <form action="{{route('students.destroy', $student->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" href="" class="btn btn-sm btn-danger m-1"
                                                onclick="return confirm('Are you sure to delete this item?')"><i
                                                class="fas fa-trash" title="  Delete"
                                            ></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    {{--                    </table>--}}
                </table>
                {{--                <div class="d-flex justify-content-center">--}}
                {{--                    {!! $coachings->links() !!}--}}
                {{--                </div>--}}
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

