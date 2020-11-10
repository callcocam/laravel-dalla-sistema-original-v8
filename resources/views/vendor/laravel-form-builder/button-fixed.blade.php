@if ($options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!}>
        @endif
        <div class="col-md-9 col-sm-9 offset-md-3">
            <btn-fixed-component>
                {{ __($options['label']) }}
            </btn-fixed-component>
        </div>

        @if ($options['wrapper'] !== false)
    </div>
@endif
