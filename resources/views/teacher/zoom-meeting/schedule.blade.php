@include('teacher.partials.header')
<div class="container-fluid">
    @include('messages')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Schedule Meeting</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('teachers.meetings.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="topic" class="col-md-4 col-form-label text-md-right">Topic</label>
                                <div class="col-md-6">
                                    <input id="topic" type="text"
                                           class="form-control @error('topic') is-invalid @enderror"
                                           placeholder="Topic of meeting"
                                           value="{{ old('topic') }}" name="topic" autocomplete="topic" autofocus>
                                    @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="start_time" class="col-md-4 col-form-label text-md-right">Start Time</label>
                                <div class="col-md-6">
                                    <input id="start_time" type="datetime-local"
                                           class="form-control @error('start_time') is-invalid @enderror"
                                           name="start_time"
                                           placeholder="Start time of meeting"
                                           value="{{ old('start_time') }}" autocomplete="start_time">
                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="agenda" class="col-md-4 col-form-label text-md-right">Agenda </label>

                                <div class="col-md-6">
                                    <input id="agenda" type="text"
                                           class="form-control @error('agenda') is-invalid @enderror"
                                           placeholder="Agenda of meeting"
                                           value="{{ old('agenda') }}" name="agenda">

                                    @error('agenda')
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
</div>
@include('teacher.partials.footer')
