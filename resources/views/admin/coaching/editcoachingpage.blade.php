@include('admin.partials.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Coaching</div>
                <div class="card-body">
                    <form method="POST" action="/coaching-update/{{$coachings->userid}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="directorname" class="col-md-4 col-form-label text-md-right">Director's Name</label>
                            <div class="col-md-6">
                                <input id="directorname" type="text" value="{{ $coachings->directorname }}" class="form-control @error('directorname') is-invalid @enderror" name="directorname" autocomplete="directorname" autofocus>
                                @error('directorname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email">

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
                                <input id="phone" type="text" value="{{ $coachings->phone }}" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="altphone" class="col-md-4 col-form-label text-md-right">Alternative Phone</label>

                            <div class="col-md-6">
                                <input id="altphone" type="text" value="{{ $coachings->altphone }}" class="form-control @error('altphone') is-invalid @enderror" name="altphone" autocomplete="altphone">

                                @error('altphone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>

                            <div class="col-md-6"><select id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" autocomplete="level" autofocus>
                                    <option value="{{ $coachings->level }}">{{ $coachings->level }}</option>
                                    @foreach($levels as $level)
                                    <option value="{{ $level->name }}">{{ $level->name }}</option>
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
                            <label for="specialization" class="col-md-4 col-form-label text-md-right">Specialization</label>

                            <div class="col-md-6">
                                <input id="specialization" type="text" value="{{ $coachings->specialization }}" class="form-control @error('specialization') is-invalid @enderror" name="specialization" autocomplete="specialization">

                                @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                            <div class="col-md-3">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" autocomplete="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                            <img src="{{ $coachings->imgpath }}" style="height: 75px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" value="{{ $coachings->description }}" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description">

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address1" class="col-md-4 col-form-label text-md-right">Street Address 1</label>

                            <div class="col-md-6">
                                <input id="address1" type="text" value="{{ $coachings->address1 }}" class="form-control @error('address1') is-invalid @enderror" name="address1">

                                @error('address1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address2" class="col-md-4 col-form-label text-md-right">Street Address 2</label>

                            <div class="col-md-6">
                                <input id="address2" type="text" value="{{ $coachings->address2 }}" class="form-control @error('address2') is-invalid @enderror" name="address2">

                                @error('address2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="landmark" class="col-md-4 col-form-label text-md-right">Landmark</label>

                            <div class="col-md-6">
                                <input id="landmark" type="text" value="{{ $coachings->landmark }}" class="form-control @error('landmark') is-invalid @enderror" name="landmark">

                                @error('landmark')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <select id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" autocomplete="state" autofocus>
                                    <option value="{{ $coachings->state }}">{{ $coachings->state }}</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                    <option value="Andaman and Nicobar">Andaman and Nicobar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Ladakh">Ladakh</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="National Capital Territory of Delhi">National Capital Territory of Delhi</option>
                                    <option value="Puducherry">Puducherry</option>
                                </select>

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
                                <input id="city" type="text" value="{{ $coachings->city }}" class="form-control @error('city') is-invalid @enderror" name="city">

                                @error('city')
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