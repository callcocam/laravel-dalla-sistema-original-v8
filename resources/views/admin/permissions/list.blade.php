@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
            @endif
            @endif
            @if ($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
            @endif
            <div class="col-md-6 col-sm-6 ">
                @if ($showField)
                    @isset($options['choice'])
                        @foreach($options['choice'] as $key => $option)
                            <label class="radio radio-outline-primary">
                                {{ Form::checkbox('privileges', $key, $key === $options['value'], $options['attr']) }} <span>{{ __($option) }}</span><span class="checkmark"></span>
                            </label>
                        @endforeach
                    @endif
                @endif

                @include('laravel-form-builder::errors')
            </div>
            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
