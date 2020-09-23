@include('partials.header')
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="banner_content text-center">
                        <h2>Register Your Coaching With Us</h2>
                        <div class="page_link">
                            <a href="{{url('/')}}">Home</a>
                            <a href="{{url('/registercoaching')}}">Register Coaching</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container m-4">
    <h3 class="mb-30 title_color">Registration Form</h3>
    <form method="POST" action="{{url('/addcoachinguser')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>
            <div class="col-md-4">
                <input id="name" type="text" class="single-input form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <label for="directorname" class="col-md-2 col-form-label text-md-right">Director's Name</label>
            <div class="col-md-4">
                <input id="directorname" type="text" class="single-input form-control @error('directorname') is-invalid @enderror" value="{{ old('directorname') }}" name="directorname" autocomplete="directorname" autofocus>
                @error('directorname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-4">
                <input id="email" type="email" class="single-input form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <label for="specialization" class="col-md-2 col-form-label text-md-right">Specialization</label>

            <div class="col-md-4">
                <input id="specialization" type="text" class="single-input form-control @error('specialization') is-invalid @enderror" value="{{ old('specialization') }}" name="specialization" autocomplete="specialization">

                @error('specialization')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-2 col-form-label text-md-right">Phone</label>
            <div class="col-md-4">
                <input id="phone" type="text" class="single-input form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" autocomplete="phone">

                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <label for="altphone" class="col-md-2 col-form-label text-md-right">Alternative Phone</label>

            <div class="col-md-4">
                <input id="altphone" type="text" class="single-input form-control @error('altphone') is-invalid @enderror" value="{{ old('altphone') }}" name="altphone" autocomplete="altphone">

                @error('altphone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

        </div>

        <div class="form-group row">
            <label for="description" class="col-md-2 col-form-label text-md-right">Description</label>

            <div class="col-md-4">
                <textarea id="description" class="single-input form-control @error('description') is-invalid @enderror" name="description"></textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <label for="image" class="col-md-2 col-form-label text-md-right">Upload Your Image</label>

            <div class="col-md-4">
                <input id="image" type="file" class="single-input form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" name="image" autocomplete="image">

                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="address1" class="col-md-2 col-form-label text-md-right">Street Address 1</label>

            <div class="col-md-4">
                <input id="address1" type="text" class="single-input form-control @error('address1') is-invalid @enderror" value="{{ old('address1') }}" name="address1">

                @error('address1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <label for="address2" class="col-md-2 col-form-label text-md-right">Street Address 2</label>

            <div class="col-md-4">
                <input id="address2" type="text" class="single-input form-control @error('address2') is-invalid @enderror" value="{{ old('address2') }}" name="address2">

                @error('address2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="landmark" class="col-md-2 col-form-label text-md-right">Level</label>

            <div class="col-md-4">
                <input id="landmark" type="text" class="single-input form-control @error('landmark') is-invalid @enderror" value="{{ old('landmark') }}" name="landmark">

                @error('landmark')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <label for="level" class="col-md-2 col-form-label text-md-right">Landmark</label>

            <div class="col-md-4">
                <input id="level" type="text" class="single-input form-control @error('level') is-invalid @enderror" value="{{ old('level') }}" name="level">

                @error('level')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="input-group-icon form-group row">
            <label for="state" class="col-md-2 col-form-label text-md-right">State</label>
            <div class="form-select col-md-4">
                <div class="icon"><i class="ti-map" aria-hidden="true"></i></div>
                <select id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" autocomplete="state" autofocus>
                    <option value="{{ old('state') }}">{{ old('state') }}</option>
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
            <label for="city" class="col-md-2 col-form-label text-md-right">City</label>

            <div class="col-md-4">
                <input id="city" type="text" class="single-input form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" name="city">

                @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-md-3">
                <button type="submit" class="click-btn btn m-2 btn-success">
                    Submit Coaching
                </button>
                <a href="{{ url('/') }}" class="btn m-2 btn-danger text-white">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>
@include('partials.footer')