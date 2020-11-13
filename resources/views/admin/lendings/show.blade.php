@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.lendings.index') }}">{{ __('Comodatas') }}</a></li>
            <li>{{ __('Visualzar Produto') }} - {{ $rows->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="ul-product-detail">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ul-product-detail__image"><img src="{{ asset($rows->cover) }}" alt="alt"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="ul-product-detail__brand-name mb-4">
                                    <h5 class="heading">{{ $rows->name }}</h5><span class="text-mute">Estoque: {{ $rows->stock }}</span>
                                </div>
                                <div class="ul-product-detail__features mt-3">
                                    <h6 class="font-weight-700">Descrição:</h6>
                                    {!! $rows->description !!}
                                </div>
                                <div class="ul-product-detail__quantity d-flex align-items-center mt-3">
                                    <a href="{{ route('admin.lendings.edit', $rows->id) }}" class="btn btn-primary m-1"><i class="fa fa-edit"></i> {{ __('Editar Produto') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

