
@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Roles') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.roles.create')
                <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')


        <div class="accordion" id="accordionExample">
            <div class="row">
                <div class="col-12">
                    @livewire("driver")
                </div>
            </div>
        </div>


@endsection

@include("admin.includes.alert")

