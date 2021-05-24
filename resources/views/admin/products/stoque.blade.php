@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Manutenção do estoque dos produtos') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.products.create')
                <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-rounded pull-right"><span
                        class="icon i-Add-File"></span> {{ __('Cadastrar') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')
    @livewire('products.stoque')
@endsection

@include("admin.includes.alert")
