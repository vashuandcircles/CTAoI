@include('admin.partials.header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Student</div>
                <div class="card-body">
                    <form method="POST" action="{{route('meetings.update',$meeting['id'])}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">Topic</label>
                            <div class="col-md-6">
                                <input id="zoom_api_key" type="text"
                                       value="{{old('zoom_api_key', 'value' )}}"
                                       class="form-control @error('zoom_api_key') is-invalid @enderror" name="zoom_api_key"
                                       autocomplete="zoom_api_key" autofocus>
                                @error('zoom_api_key')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">Topic</label>
                            <div class="col-md-6">
                                <input id="zoom_api_secret" type="text"
                                       value="{{old('zoom_api_secret', 'value' )}}"
                                       class="form-control @error('zoom_api_secret') is-invalid @enderror" name="zoom_api_secret"
                                       autocomplete="zoom_api_secret" autofocus>
                                @error('zoom_api_secret')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                                <a href="{{ route('meetings.index')}}" class="btn btn-danger text-white">
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
