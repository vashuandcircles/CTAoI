@include('admin.partials.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Event</div>
                <div class="card-body">
                    <form method="POST" action="{{url('/addevent')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Event Date</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" name="date" autocomplete="date" autofocus>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="starttime" class="col-md-4 col-form-label text-md-right">Start Time</label>

                            <div class="col-md-6">
                                <input id="starttime" type="time" class="form-control @error('starttime') is-invalid @enderror" name="starttime" value="{{ old('starttime') }}" autocomplete="starttime">

                                @error('starttime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="endtime" class="col-md-4 col-form-label text-md-right">End Time</label>

                            <div class="col-md-6">
                                <input id="endtime" type="time" class="form-control @error('endtime') is-invalid @enderror" name="endtime" value="{{ old('endtime') }}" autocomplete="endtime">

                                @error('endtime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smalldesc" class="col-md-4 col-form-label text-md-right">Short Description</label>

                            <div class="col-md-6">
                                <input id="smalldesc" type="text" class="form-control @error('smalldesc') is-invalid @enderror" name="smalldesc" value="{{ old('smalldesc') }}" maxlength="40" autocomplete="smalldesc">

                                @error('smalldesc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="priority" class="col-md-4 col-form-label text-md-right">Order</label>

                            <div class="col-md-6">
                                <input id="priority" type="number" class="form-control @error('priority') is-invalid @enderror" name="priority" value="{{ old('priority') }}" autocomplete="priority">

                                @error('priority')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="imagepath" class="col-md-4 col-form-label text-md-right">Image</label>

                            <div class="col-md-6">
                                <input id="imagepath" type="file" class="form-control @error('imagepath') is-invalid @enderror" name="imagepath" value="{{ old('imagepath') }}" autocomplete="imagepath">

                                @error('imagepath')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                                <a href="{{ url('/adminrole-register') }}" class="btn btn-danger text-white">
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