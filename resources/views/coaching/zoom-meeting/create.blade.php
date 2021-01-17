@include('coaching.partials.header')
<div class="container-fluid">
    @include('messages')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
           <span class="card-title">
                <strong>
                    Zoom meeting Configuration
                </strong>
            </span>
            <div class="pull-right float-right">
                <button title="Nee Help to configure ?" class="btn btn-primary">
                    <i class="fa fa-question"></i> Need Help
                </button>

            </div>
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
