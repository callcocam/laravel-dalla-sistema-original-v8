@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
            @endif
            @endif

            @if ($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
            @endif
            <div class="{{$options['label_show']? 'col-md-9 col-sm-9':'col-md-12'}}">
                @if ($showField)
                    @isset($options['choices'])
                        @foreach($options['choices'] as $key => $option)
                            <label class="checkbox checkbox-outline-success">
                                @if($options['multiple'])
                                    {{ Form::checkbox(sprintf("%s[]",$name), $key, $key === $options['value'], $options['attr']) }} <span>{{ __($option) }}</span><span class="checkmark"></span>
                                @else
                                    {{ Form::checkbox($name, $key, $key === $options['value'], $options['attr']) }} <span>{{ __($option) }}</span><span class="checkmark"></span>
                                @endif
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
