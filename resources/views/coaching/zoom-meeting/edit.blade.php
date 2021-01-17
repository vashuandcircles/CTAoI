@include('coaching.partials.header')
<div class="container-fluid">
    @include('messages')
    @php($buttonText='Update')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="card-title">Zoom meeting Configuration</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('coaching.meetings.configuration.update',$zoomConfig->id)}}">
                {{method_field('PATCH')}}
                @csrf
                @include('coaching.zoom-meeting.configuration',['key'=>$zoomConfig->zoom_api_key,'secret'=>$zoomConfig->zoom_api_secret])
            </form>
        </div>
    </div>
</div>
@include('coaching.partials.footer')
