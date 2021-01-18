@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.orders.index') }}">{{ __('Pedido') }} </a></li>
            <li>{{ str_pad($rows->id, 7, '0', STR_PAD_LEFT) }} - {{ __('Atualizar') }}</li>
        </ul>
    </div>
@endsection
@section('content')
         @if($user->hasAnyRole('cliente'))
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="alert alert-card alert-danger" role="alert"><strong
                            class="text-capitalize">ATENÇÃO!!</strong>
                        Se você está fazendo este pedido entre o período de quinta feira a noite até domingo a noite,
                        seu pedido só será processado na próxima semana, para maiores informações, ligue para a fábrica.
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-hover mb-3">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('Nome Do Produto') }}</th>
                                    <th scope="col">{{ __('Quantidade') }}</th>
                                    @if(!$user->hasAnyRole('cliente'))
                                        <th scope="col">{{ __('Valor Unit.') }}</th>
                                        <th scope="col">{{ __('Total') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rows->items()->get() as $item)
                                    @include('admin.orders.items.list-cloused', [
                                    'item'=>$item
                                    ])
                                @empty
                                    <tr>
                                        <th scope="row" colspan="6">Não a items para o pedido corrente</th>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-12">
                            @include('admin.orders.total')
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mt-5">
            <!-- ====  NÃO COLOCAR A LISTA DE ITEMS DE PEDIDO DENTRO DO FORMULARIO NÃO SABERIA DIZER QUAL SERIA O COMPORTAMENTO =====-->
            <div class="col-md-12">
                <!-- ==== Edit Area =====-->
                {!! form_row($form->number) !!}
                {!! form_row($form->id) !!}
                <div class="mt-3 mb-4 border-top"></div>
                <div class="row mb-5">
                    <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input class="form-control  form-control-rounded" value=" {{ $rows->client->name }}">
                        </div>
                    </div>
                    </div>
                <!-- NÂO ESTOU USANDO -->
                    <div class="col-md-12">
                        {!! form_row($form->description) !!}
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <input class="form-control  form-control-rounded" value=" {{ check_status_text($rows->status, order_status()) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
