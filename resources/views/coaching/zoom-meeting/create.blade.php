@include('coaching.partials.header')
<div class="container-fluid">
    @include('messages')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="card-title">Zoom meeting Configuration</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('coaching.meetings.configuration')}}">
                @csrf
                @include('coaching.zoom-meeting.configuration')
            </form>
        </div>
    </div>
</div>
@include('coaching.partials.footer')
