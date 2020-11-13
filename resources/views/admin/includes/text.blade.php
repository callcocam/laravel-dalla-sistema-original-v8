<label class="col-form-label col-md-3 col-sm-3 label-align" for="{{$name}}">{{ __($label) }}
    @isset($required)
        <span class="required">*</span>
    @endisset
</label>
<div class="col-md-6 col-sm-6 ">
    <input type="text" name="{{$name}}" id="{{$name}}"
            @isset($value)
              value="{{ $value }}"
            @endisset
           class="form-control @error($name) is-invalid @enderror"
           placeholder="{{ __($label) }}" />
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
