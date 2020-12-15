@include('admin.partials.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Coaching Register</div>
                <div class="card-body">
                    <form method="POST" action="{{route('students.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" name="name" autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}" autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       value="{{ old('password') }}" autocomplete="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>
                            <div class="col-md-6">
                                <select id="level" type="text" class="form-control @error('level') is-invalid @enderror"
                                        name="level" autocomplete="level" autofocus>
                                    <option value="">Select</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->name }}"
                                                @if (old('level') == $level->name) selected="selected"
                                            @endif>
                                            {{ $level->name }}</option>
                                    @endforeach
                                </select>

                                @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          value="{{ old('description') }}" name="description"></textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Upload Your Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                       value="{{ old('image') }}" name="image" autocomplete="image">

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                            <div class="col-md-6">
                                <select id="gender" type="text"
                                        class="form-control @error('gender') is-invalid @enderror"
                                        name="gender" autocomplete="gender" autofocus>
                                    @if(old('gender'))
                                        <option value="{{ old('gender') }}">{{ old('gender') }}</option>
                                    @endif
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address </label>

                            <div class="col-md-6">
                                <input id="address1" type="text"
                                       class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address') }}" name="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                @include('students.partials.state-option')
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                       value="{{ old('city') }}" name="city">

                                @error('city')
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
                                <a href="{{ route('students.index')}}" class="btn btn-danger text-white">
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
