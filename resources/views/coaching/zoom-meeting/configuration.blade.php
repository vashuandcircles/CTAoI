<div class="form-group row">
    <label for="zoom_api_key" class="col-md-4 col-form-label text-md-right">Zoom API Key</label>
    <div class="col-md-6">
        <input id="zoom_api_key" type="text"
               class="form-control @error('zoom_api_key') is-invalid @enderror"
               placeholder="Enter Zoom API key"
               value="{{ old('zoom_api_key') ?? $key ? $key:null}}" name="zoom_api_key" autocomplete="topic" autofocus>
        @error('zoom_api_key')
        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="zoom_api_secret" class="col-md-4 col-form-label text-md-right">Zoom API Secret</label>
    <div class="col-md-6">
        <input id="zoom_api_secret" type="text"
               class="form-control @error('zoom_api_secret') is-invalid @enderror"
               placeholder="Enter Zoom Secret Key"
               value="{{ old('zoom_api_secret') ?? $secret ? $secret:null }}" name="zoom_api_secret"
               autocomplete="zoom_api_secret"
               autofocus>
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
            {{$buttonText ?? 'Create'}}
        </button>
        <a href="javascript:history.back()" class="btn btn-danger text-white">
            Cancel
        </a>
    </div>
</div>

