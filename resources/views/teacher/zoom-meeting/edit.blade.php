@include('teacher.partials.header')
<div class="container-fluid">
    @include('messages')
    @php($buttonText='Update')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="card-title">
                <strong>
                    Zoom meeting Configuration
                </strong>
            </span>
            <div class="pull-right float-right">
                <a title="Nee Help to configure ?" class="btn btn-primary" href="{{route('teachers.meetings.help')}}">
                    <i class="fa fa-question"></i> Need Help
                </a>

            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('teachers.meetings.configuration.update',$zoomConfig->id)}}">
                {{method_field('PATCH')}}
                @csrf
                @include('teacher.zoom-meeting.configuration',['key'=>$zoomConfig->zoom_api_key,'secret'=>$zoomConfig->zoom_api_secret])
            </form>
        </div>
    </div>
</div>
@include('teacher.partials.footer')
