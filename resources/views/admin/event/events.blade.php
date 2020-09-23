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
                        <!-- @foreach ($queries as $row => $query)
                        <tr>
                            <td>{{ $row+1 }}</td>
                            <td>{{ $query['name']}}</td>
                            <td>{{ $query['phone']}}</td>
                            <td>{{ $query['email']}}</td>
                            <td>{{ $query['subject']}}</td>
                            <td>{{ $query['message']}}</td>
                        </tr>
                        @endforeach -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')