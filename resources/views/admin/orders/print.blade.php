@extends('layouts.print')
@section('content')
<div id="print-area">
    <div class="row">
        <div class="col-md-6">
            <h4 class="font-weight-bold">Informações do pedido</h4>
            <p>#{{ $rows->number }}</p>
        </div>
        <div class="col-md-6 text-sm-right">
            <p><strong>Situação: </strong>{{ check_status_text($rows->status,order_status()) }}</p>
        </div>
    </div>
    <div class="mt-3 mb-4 border-top"></div>
    <div class="row mb-5">
        <div class="col-md-12 mb-3 mb-sm-0">
            <h5 class="font-weight-bold">Infromações do cliente</h5>
            <p>{{ $rows->client->name }}</p>
            <p><b>CNPJ/CPF</b>{{ $rows->client->document }}</p>
            <p><b>Telefone:</b> {{ $rows->client->phone }}</p>
            <span>
                    @if($rows->client->address)
                        @if($rows->client->address->city)
                            {{ $rows->client->address->city }},
                        @endif
                        @if($rows->client->address->state)
                            {{ $rows->client->address->state }},
                        @endif
                        @if($rows->client->address->zip)
                            {{ $rows->client->address->zip }},
                        @endif
                        @if($rows->client->address->street)
                            {{ $rows->client->address->street }},
                        @endif
                        @if($rows->client->address->number)
                            {{ $rows->client->address->number }},
                        @endif
                        @if($rows->client->address->district)
                            {{ $rows->client->address->district }},
                        @endif
                        @if($rows->client->address->complement)
                            {{ $rows->client->address->complement }}
                        @endif
                    @endif
                    </span>
        </div>
        <div class="col-md-12 text-sm-right">
            <p>Observações</p><span style="white-space: pre-line">
                                                {!! $rows->description !!}
                                            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-hover mb-4">
                <thead>
                <tr>
                    <th scope="col" width="10">#</th>
                    <th scope="col">{{ __('Nome Do Produto') }}</th>
                    <th scope="col" width="10">{{ __('Quantidade') }}</th>
                    <th scope="col" width="15">{{ __('Valor Unit.') }}</th>
                    <th scope="col">{{ __('Total') }}</th>
                </tr>
                </thead>
                <tbody>

                @forelse($rows->items()->get() as $item)
                    <tr>
                        <th scope="row">{{ str_pad($item->id,5, '0', STR_PAD_LEFT) }}</th>
                        <td>{{ $item->products->name }}</td>
                        <td>{{ (int)$item->amount }}</td>
                        <td>{{ form_read($item->price) }}</td>
                        <td>{{ form_read($item->total) }}</td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row" colspan="5">Não a items para o pedido corrente</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <div class="">
                <p>{{ __('Sub Total') }}: <span>{{ form_read($rows->price) }}</span></p>
                @if($rows->discount)
                    <p>{{ __('Desconto') }}: <span>{{ form_read($rows->discount) }}</span></p>
                @endif
                <h3>{{ __('Valor Total') }}: <b>{{ form_read($rows->total) }}</b></h3>
            </div>
        </div>
    </div>
</div>
@endsection
