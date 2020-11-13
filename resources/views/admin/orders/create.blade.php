@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.orders.index') }}">{{ __('Pedidos') }}</a></li>
            <li>{{ __('Cadastrar') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- ==== Edit Area =====-->
            {!! form_start($form) !!}
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <h4 class="font-weight-bold">Informações do pedido</h4>
                        <div class="col-sm-4 form-group mb-3 pl-0">
                            <label for="orderNo">Número Do Pedido</label>
                            <span class="form-control">#0000</span>
                            {!! form_row($form->number,['value' => \Faker\Provider\Uuid::numerify()]) !!}
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <label class="d-block text-12 text-muted">{{ __('Situação do pedido') }}</label>
                        <div class="pr-0 mb-4">
                            {!! form_row($form->status) !!}
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-4 border-top"></div>
                <div class="row mb-5">

                    @if($user->hasAnyRole('cliente'))
                        <div class="col-md-12">
                            <h5 class="font-weight-bold">{{ __("Cliente") }}</h5>
                            {!! form_row($form->client_id,['value' => $user->id]) !!}
                            {!! form_row($form->client_name,['value' => $user->name]) !!}
                        </div>
                    @else
                        <div class="col-md-12">
                            <h5 class="font-weight-bold">{{ __("Selecione um cliente") }}</h5>
                            {!! form_row($form->client_id) !!}
                        </div>
                    @endif

                    <div class="col-md-12">
                        {!! form_row($form->description) !!}
                    </div>
                </div>
            <div class="d-flex mb-5"><span class="m-auto"></span>
                <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> {{ __('Cadastrar Pedido') }}</button>
            </div>
            {!! form_end($form) !!}
        </div>
    </div>
@endsection


