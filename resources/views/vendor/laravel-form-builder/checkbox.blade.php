@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
            @endif
            @endif
            @if ($showField)
                <label class="checkbox checkbox-outline-success">
                    {!! Form::checkbox($name, $options['value'], $options['checked'], $options['attr']) !!}
                    @if ($showLabel && $options['label'] !== false && $options['label_show'])
                        <span>{{ __($options['label']) }}</span><span class="checkmark"></span>
                    @endif
                    @endif
                </label>
                @include('laravel-form-builder::errors')
                @if ($showLabel && $showField)
                    @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
