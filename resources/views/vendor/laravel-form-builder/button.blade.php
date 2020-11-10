@if ($options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!}>
        @endif
        <div class="col-md-12 mb-5">
            {!! Form::button(__($options['label']), $options['attr']) !!}
            @include('laravel-form-builder::errors')
            @include('laravel-form-builder::help_block')
        </div>

        @if ($options['wrapper'] !== false)
    </div>
@endif
