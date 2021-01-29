@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Manutenção do preço dos produtos') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    @livewire('products.price')
@endsection

@include("admin.includes.alert")
