@if(!in_array($rows->status, ["completed",'preparing','transit','in_billing']) || !$user->hasAnyRole('cliente'))
@extends('layouts.admin')
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
@can('update', $rows)
@if($user->hasAnyRole('cliente'))
<div class="row justify-content-between">
    <div class="col-md-12">
        <div class="alert alert-card alert-danger" role="alert"><strong class="text-capitalize">ATENÇÃO!!</strong>
            Se você está fazendo este pedido entre o período de quinta feira a noite até domingo a noite, seu pedido só será processado na próxima semana, para maiores informações, ligue para a fábrica.
        </div>
    </div>
</div>
@endif
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @livewire('orders.items',compact('rows'))
                    </div>

                </div>
            </div>
        </div>
<div class="row mt-5">
    <!-- ====  NÃO COLOCAR A LISTA DE ITEMS DE PEDIDO DENTRO DO FORMULARIO NÃO SABERIA DIZER QUAL SERIA O COMPORTAMENTO =====-->
    <div class="col-md-12">
        <!-- ==== Edit Area =====-->
        {!! form_start($form) !!}
        {!! form_row($form->number) !!}
        {!! form_row($form->id) !!}


        <div class="mt-3 mb-4 border-top"></div>
        <div class="row mb-5">

            @if($user->hasAnyRole('cliente'))
            <div class="col-md-12">
                {!! form_row($form->client_id) !!}
            </div>
            @else
            <div class="col-md-12">
                <h5 class="font-weight-bold">{{ __("Selecione um cliente") }}</h5>
                {!! form_row($form->client_id) !!}
            </div>
            @endif
            <!-- NÂO ESTOU USANDO -->
            <div class="col-md-12">
                @if(!$user->hasAnyRole('cliente') && 1==2)
                @if($rows->client)
                @if($rows->client->bonification)
                <div class="ul-widget__item">
                    <div class="ul-widget__info">
                        <h3 class="ul-widget1__title">{{ __(sprintf('Esse cliente tem (%s) bonificação:',count($rows->client->bonification))) }}</h3>
                        @foreach($rows->client->bonification as $bonification)
                        <span class="ul-widget__desc text-mute">
                            {{ $bonification->bonusId($bonification)->name }}, {{ $bonification->bonusId($bonification)->description }}
                        </span><a href="{{ route('admin.bonificacoes.application', $bonification->id) }}">Aplicar bonificação</a><br>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
                @endif
                {!! form_row($form->description) !!}
            </div>

            <div class="col-md-12">
                <label class="d-block text-12 text-muted">{{ __('Situação do pedido') }}</label>
                <div class="pr-0 mb-4">
                    {!! form_row($form->status) !!}
                </div>
            </div>
        </div>
        <div class="d-flex mb-5"><span class="m-auto"></span>
            <button class="btn btn-success btn-lg"><i class="fa fa-save"></i> {{ __('Atualizar Pedido') }}</button>
        </div>
        {!! form_end($form) !!}
    </div>
</div>

@endcan
@cannot('update', $rows)
@include('admin.includes.not-authorized', [
'url' =>route('admin.orders.index')
])
@endcannot

@endsection

@can('update', $rows)
@push("styles")
<link href="{{ asset('/_dist/admin/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/_dist/admin/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endpush

@push("scripts")
<script src="{{ asset('/_dist/admin/js/select2.min.js') }}"></script>
<script src="{{ asset('/_dist/admin/js/i18n/pt-BR.js') }}"></script>
<script>
    $(function() {

        $(".delete-item").click(function(e) {

            $($(this).data('id')).submit()

        })
        $(".update-item").click(function() {

            $($(this).data('id')).submit()
        })
    });
</script>
@endpush

@endcan
@else
    @include("admin.orders.cloused")
@endif
