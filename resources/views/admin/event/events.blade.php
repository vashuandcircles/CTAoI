@include('admin.partials.header')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <h6 class="m-3 font-weight-bold text-primary">Events</h6>
                <a href="{{ url('/addeventpage') }}" class="m-2 ml-auto btn btn-primary text-white">
                    Add Event
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $row => $events)
                        <tr>
                            <td>{{ $row+1 }}</td>
                            <td> <div class="text-center"> <img src="{{ $events['imagepath']}}" height="150px"/> </div></td>
                            <td>{{ $events['date']}}</td>
                            <td>{{ $events['starttime']}}</td>
                            <td>{{ $events['endtime']}}</td>
                            <td>{{ $events['smalldesc']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')