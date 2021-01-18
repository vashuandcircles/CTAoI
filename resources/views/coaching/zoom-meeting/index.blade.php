@include('coaching.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="card-title">Zoom meetings</h3>
            <div class="card-tools float-right">
                @inject('zoomMeetingConfig','App\Http\Controllers\Zoom\ZoomMetingConfiguration')
                @if($zoomMeetingConfig->hasZoomCredentials())
                    <a href="{{route('coaching.meetings.schedule')}}" class="btn btn-success">
                        Schedule Meeting
                    </a>
                @else
                    <a href="{{route('coaching.meetings.configuration')}}" class="btn btn-success">
                        Set Zoom Credentials
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        S.No
                    </th>
                    <th>
                        Topic
                    </th>
                    <th>Start Time</th>
                    <th>Url</th>
                </tr>
                </thead>
                <tbody>
                @isset($zoom['meetings'])
                    @forelse($zoom['meetings'] as$key=> $meeting)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$meeting['topic']}}</td>
                            <td>{{\Carbon\Carbon::parse($meeting['start_time'])}}</td>
                            <td>
                                <a href="{{$meeting['join_url']}}"
                                   target="_blank"
                                   class="btn btn-flat btn-primary">
                                    Join
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="">No data is recorded.</td>
                        </tr>
                    @endforelse
                @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('coaching.partials.footer')
