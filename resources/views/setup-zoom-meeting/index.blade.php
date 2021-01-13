@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Zoom credentials</h6>
                <a href="{{ route('meetings.create') }}" class="m-2 ml-auto btn btn-primary text-white">
                    create credentials
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
                        <th>ZOOM_API_KEY</th>
                        <th>ZOOM_API_SECRET</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($credentials as $credential)
                        <tr>
                            <td>{{$credential->zoom_api_key}}</td>
                            <td>{{$credential->zoom_api_secret}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-3">
                                        <a href="#{{--{{route('meetings.edit', $credential->id) }}--}}"
                                           class="btn btn-secondary m-1"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="col-3">
                                        <form action="#{{--{{route('meetings.destroy',  $credential->id) }}--}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" href="" class="btn btn-danger m-1"
                                                    onclick="return confirm('Are you sure to delete this item?')"><i
                                                    class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
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

