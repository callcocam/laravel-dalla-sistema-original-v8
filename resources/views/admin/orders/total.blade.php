@if(!$user->hasAnyRole('cliente'))
    <div class="invoice-summary invoice-summary-input float-right">
        <p>{{ __('Sub Total') }}: <span>{{ form_read($rows->price) }}</span></p>
        @if($rows->discount)
            <p class="d-flex align-items-center">{{ __('Desconto') }}:<span>( % {{ form_read($rows->client->discount) }} ) - {{ form_read($rows->discount) }}</span></p>
        @endif
        <h5 class="font-weight-bold d-flex align-items-center">{{ __('Valor Total') }}:<span>{{ form_read($rows->total) }}</span></h5>
    </div>
@endif
