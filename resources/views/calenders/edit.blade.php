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
                                <input id="topic" type="text"
                                       value="{{old('topic', $meeting['topic'] )}}"
                                       class="form-control @error('topic') is-invalid @enderror" name="topic"
                                       autocomplete="topic" autofocus>
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
                                       class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                       placeholder="Start time of meeting"
                                       value="{{ old('start_time',$meeting['start_time']) }}" autocomplete="start_time">
                                @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agenda" class="col-md-4 col-form-label text-md-right">Agenda</label>
                            <div class="col-md-6">
                                <input id="agenda" type="text"
                                       value="{{old('agenda', $meeting['agenda'] )}}"
                                       class="form-control @error('agenda') is-invalid @enderror" name="agenda"
                                       autocomplete="agenda" autofocus>
                                @error('agenda')
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
