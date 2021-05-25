@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.categories.index') }}">{{ __('Categoria') }}</a></li>
            <li>{{ __('Delete') }} - {{ $rows->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">{{ $rows->name }}</div>
                <div class="card-body">

                    {!! $rows->description !!}

                </div>
                <div class="card-footer">

                    <form action="{{ route('admin.categories.destroy',$rows->id) }}" method="POST">
                        @can('admin.categories.destroy')
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-warning btn-rounded">{{ __('Excluir post') }}</button>
                        @endcan
                        @can('admin.categories.index')
                            <a class="btn btn-danger btn-rounded"
                               href="{{ route('admin.categories.index') }}">{{ __('Voltar Para Categorias') }}</a>
                        @endcan
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
