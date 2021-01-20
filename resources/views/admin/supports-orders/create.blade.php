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
            Cadastrar pedido de material de apoio
        </div>
    </div>
@endsection


