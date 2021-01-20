@include('coaching.partials.header')
<div class="container-fluid">
    @include('messages')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="card-title">Zoom meetings</h3>
            <div class="card-tools float-right">
                @inject('zoomMeetingConfig','App\Http\Controllers\Zoom\ZoomMetingConfiguration')
                @if($zoomMeetingConfig->hasZoomCredentials())
                    <a href="{{route('coaching.meetings.schedule')}}" class="btn btn-primary">
                        Schedule Meeting
                    </a>
                @else
                    <a href="{{route('coaching.meetings.configuration')}}" class="btn btn-primary">
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
                    <th>Join</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @isset($zoom['meetings'])
                    @forelse($zoom['meetings'] as$key=> $meeting)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$meeting['topic']}}</td>
                            <td>{{$meeting['start_time'] ? \Carbon\Carbon::parse($meeting['start_time'])->format('Y-m-d H:i'):''}}</td>

{{--                            <td>{{\Carbon\Carbon::parse($meeting['start_time'])}}</td>--}}
                            <td>
                                <a href="{{$meeting['join_url']}}" class="btn btn-success">
                                    Join
                                </a>
                            </td>
                            <td>
                                <div class="row">
                                    <button data-url="{{$meeting['join_url']}}"
                                            data-tooltip="Link copied to clipboard"
                                            class="btn btn-secondary m-1 copyUrl"><i class="fas fa-copy"></i></button>
                                    <a href="{{route('coaching.meetings.edit', $meeting['id']) }}"
                                       class="btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('coaching.meetings.destroy',  $meeting['id']) }}"
                                          method="POST" style="display:inherit;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" href="" class="btn btn-sm btn-danger m-1"
                                                onclick="return confirm('Are you sure to delete this item?')"><i
                                                class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
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
