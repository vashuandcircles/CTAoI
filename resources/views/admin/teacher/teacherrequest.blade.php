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
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers as $teacher)
                        @if (!$teacher->verified && $teacher->active)
                            <tr>
                                <td>

                                    <img src="{{$teacher->imgpath ?? asset('/img/default-user.jpg')}}"
                                         class="rounded-circle" alt="img"
                                         style="width: 75px; height: 75px; object-fit: cover;">
                                </td>
                                <td>{{  $teacher->user->name}}</td>
                                <td>{{  $teacher->user->phone }}</td>
                                <td>{{  $teacher->user->email }}</td>
                                <td>
                                    <div class="row">
                                        <form action="/teacher-accept/{{ $teacher->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button type="submit" href="" class="btn btn-sm btn-success m-1"><i
                                                    class="fas fa-check" title="  Accept"></i>
                                            </button>
                                        </form>
                                        <form action="/teacher-delete/{{ $teacher->id }}" method="POST"
                                              onclick="return confirm('Are you sure to Decline this item?')">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" href="" class="btn btn-sm btn-danger m-1"><i
                                                    class="fas fa-times" title="  Decline"></i>
                                            </button>
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
