@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Meetings</h6>
                @inject('zoomConfig','App\Http\Controllers\Zoom\ZoomMetingConfiguration')
                @if(!$zoomConfig->hasZoomCredentials())
                    <a href="{{ route('meetings.setup') }}" class="float-right m-2 ml-auto btn btn-primary text-white">
                        Set up credentials
                    </a>
                @else
                    <a href="{{ route('meetings.create') }}" class="m-2 ml-auto btn btn-primary text-white flo">
                        Schedule
                    </a>
                @endif
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
                @if($zoomConfig->hasZoomCredentials())
                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Meeting Id</th>
                            <th>Topic</th>
                            <th>Start Time</th>
                            <th>Duration</th>
                            <th>Join Url</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($meetings['meetings'] as $meeting)
                            <tr>
                                <td>{{$meeting['id']}}</td>
                                <td>{{$meeting['topic']}}</td>
                                <td>{{$meeting['start_time'] ? \Carbon\Carbon::parse($meeting['start_time'])->format('Y-m-d H:i:s'):''}}</td>
                                <td>{{$meeting['duration']}}</td>
                                <td>
                                    <a href="{{$meeting['join_url']}}" target="_blank"
                                       class="btn btn-info m-1">Join</a>
                                </td>
                                <td>
                                    <div class="row">
                                        <button data-url="{{$meeting['join_url']}}"
                                                title="Copy Meeting Url"
                                                data-tooltip="Link copied to clipboard"
                                                class="btn btn-secondary m-1 copyUrl"><i class="fas fa-copy"></i>
                                        </button>
                                        <a href="{{route('meetings.edit', $meeting['id']) }}" title="Edit"
                                           class="btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i></a>
                                        <form action="{{route('meetings.destroy',  $meeting['id']) }}" method="POST"
                                              style="display: inherit">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-sm btn-danger m-1"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure to delete this item?')"><i
                                                class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{--                        @endif--}}
                @else


                    <div class="card-title">
                        <h1>Please Setup your Zoom credentials.</h1>
                    </div>
                @endif

                {{--                    </table>--}}

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

