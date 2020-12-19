@include('admin.partials.header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Student</div>
                <div class="card-body">
                    <form method="POST" action="{{route('meetings.update',$meeting->id)}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
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
                                <input id="start_time" type="time"
                                       class="form-control @error('start_time') is-invalid @enderror" name="start_time" placeholder="Start time of meeting"
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
                                       value="{{old('topic', $meeting['agenda'] )}}"
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
                                <a href="{{ url('/teacher-page') }}" class="btn btn-danger text-white">
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
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCMcBN7TZA1E2lRHPBN0oryMfs6WGBleXk&callback=initAutoComplete" type="text/javascript"></script>
<script>
    var autocomplete;

    function initAutoComplete() {

        autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {
            types: ['establishment'],
            componentRestrictions: {
                'country': ['IN']
            },
            fields: ['place_id', 'geometry', 'name']
        });

        autocomplete.addListener('place_changed', onPlaceChanged);
    }

    function onPlaceChanged() {
        var place = autocomplete.getPlace();

        if (!place.geometry) {
            document.getElementById('address').placeholder = 'Enter a place:';
        } else {
            document.getElementById('details').innerHTML = place.name;
        }

    }
</script> -->

@include('admin.partials.footer')
