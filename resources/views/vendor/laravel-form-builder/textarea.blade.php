@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
            @endif
            @endif
            @if ($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::customLabel(__($name), __($options['label']), $options['label_attr']) !!}
            @endif
            <div class="{{$options['label_show']? 'col-md-9 col-sm-9':'col-md-12'}}">
                @if ($showField)
                    {!! Form::textarea($name, $options['value'], array_merge([
                'placeholder'=>isset($options['label']) && !empty($options['label'])?$options['label']:$name
                ],$options['attr'])) !!}
                @endif
                @include('laravel-form-builder::errors')
                @include('laravel-form-builder::help_block')
            </div>
            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
