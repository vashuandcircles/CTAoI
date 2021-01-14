@include('admin.partials.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    credentials
                    <a href="{{route('zoom-meeting-rooms')}}">
                        <div
                            class="m-2 ml-auto btn btn-sm btn-primary text-white float-right">Way to Create Zoom Credentials</div>
                    </a>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('meetings.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">zoom api key</label>
                            <div class="col-md-6">
                                <input id="topic" type="text" class="form-control @error('zoom_api_key') is-invalid @enderror"
                                       placeholder="Topic of meeting"
                                       value="{{ old('zoom_api_key') }}" name="zoom_api_key" autocomplete="zoom_api_key" autofocus>
                                @error('zoom_api_key')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">zoom api key</label>
                            <div class="col-md-6">
                                <input id="topic" type="text" class="form-control @error('zoom_api_secret') is-invalid @enderror"
                                       placeholder="Topic of meeting"
                                       value="{{ old('zoom_api_secret') }}" name="zoom_api_secret" autocomplete="zoom_api_secret" autofocus>
                                @error('zoom_api_secret')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="create" class="btn btn-primary">
                                    Create
                                </button>
                                <a href="{{ route('meetings.setup')}}" class="btn btn-danger text-white">
                                    Cancel
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')
