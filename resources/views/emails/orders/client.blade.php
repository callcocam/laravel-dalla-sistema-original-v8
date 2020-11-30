@component('mail::message')
{{ $client_title }}
<br />
<div>
    <div>
        <div>
            <a target="_blank" href="{{ route('admin.orders.print', $rows->id) }}">Imprimir Pedido</a>
        </div>
        <!-- -===== Print Area =======-->
        <div>
            <div>
                <div>
                    <p><strong>Situação: </strong>{{ check_status_text($rows->status,['not-accepted'=>'Não aceito','open'=>'Aberto','transit'=>'Em transito','completed'=>'Completo']) }}</p>
                </div>
            </div>
            <div>
                <div>
                    <h5>Infromações do cliente</h5>
                    <p>{{ $rows->client->name }}</p><span>
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
            </div>
            <table>
                <tr>
                    <th>#</th>
                    <th>{{ __('Nome Do Produto') }}</th>
                    <th>{{ __('Quantidade') }}</th>
                </tr>
                @foreach($rows->items()->get() as $item)
                    <tr>
                        <td>{{ str_pad($item->id,5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->products->name }}</td>
                        <td>{{ (int)$item->amount }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@component('mail::button', ['url' => $url])
Visualizar pedido
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
