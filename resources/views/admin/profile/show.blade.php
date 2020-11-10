@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Minha Conta') }}</li>
        </ul>
    </div>
@endsection
@section('content')

    <div class="card user-profile o-hidden mb-4">
        <div class="header-cover" style="background-image: url({{ asset('_dist/admin/images/photo-wide-4.jpg') }})"></div>
        <div class="user-info"><img class="profile-picture avatar-lg mb-2" src="{{ url($rows->avatar) }}" alt="" id="image_tag"/>
            <p class="m-0 text-24">{{ $rows->name }}</p>
            <p class="text-muted m-0">{{ $rows->email }}</p>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myIconTab" role="tablist">
                <li class="nav-item"><a class="nav-link active show" id="home-icon-tab" data-toggle="tab" href="#home" role="tab" aria-controls="homeIcon" aria-selected="false"><i class="nav-icon i-Home1 mr-1"></i>{{ __("Meus Dados") }}</a></li>
                <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-toggle="tab" href="#history" role="tab" aria-controls="profileIcon" aria-selected="true"><i class="nav-icon i-Line-Chart-2 mr-1"></i> {{ __('Histórico De Atividades') }}</a></li>
            </ul>
            <div class="tab-content" id="myIconTabContent">
                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-icon-tab">
                    {!! form($form) !!}
                </div>
                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="profile-icon-tab">

                    <div class="card-body">
                        <div class="card-title">{{ __("Últimos produto adquiridos") }}</div>

                        @if($rows->orders)
                            @foreach($rows->orders as $order)
                                @can('view', $order)
                                    @foreach($order->items as $item)
                                        <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-3"><img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="{{ asset($item->products->cover) }}" alt="{{ $item->products->name }}">
                                            <div class="flex-grow-1">
                                                <h5><a href="{{ route('admin.products.show', $item->products->id) }}">{{ $item->products->name }}</a></h5>
                                                <p class="m-0 text-small text-muted">{{ __('Quantidade') }}: {{ str_pad((int)$item->amount, 5, '0', STR_PAD_LEFT) }}</p>
                                                <p class="text-small text-danger m-0"> R$ {{ form_read($item->products->price) }}</p>
                                            </div>
                                            <div>
                                                <a title="Ver detalhes do pedido" href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-rounded btn-sm">
                                                    {{ __('Ver Pedido') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endcan
                            @endforeach
                        @endif
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection


