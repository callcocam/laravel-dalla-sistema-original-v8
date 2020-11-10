@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.products.index') }}">{{ __('Produtos') }}</a></li>
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
{{--                                <div class="ul-product-detail__price-and-rating d-flex align-items-baseline">--}}
{{--                                    <h3 class="font-weight-700 text-primary mb-0 mr-2">R$ {{ form_read($rows->price) }}</h3>--}}
{{--                                </div>--}}
                                <div class="ul-product-detail__features mt-3">
                                    <h6 class="font-weight-700">Descrição:</h6>
                                    {!! $rows->description !!}
                                </div>
                                <div class="ul-product-detail__quantity d-flex align-items-center mt-3">
                                    <a href="{{ route('admin.products.edit', $rows->id) }}" class="btn btn-primary m-1"><i class="fa fa-edit"></i> {{ __('Editar Produto') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="ul-product-detail__box">
            <div class="row">

                <div class="col-lg-6 col-md-6 mt-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2"><i class="i-Reload text-danger text-25 font-weight-500"></i></div>
                                <h5 class="heading">Estoque</h5>
                                <p class="text-muted text-12">{{ $rows->stock }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2"><i class="fa fa-shopping-cart text-success text-25 font-weight-500"></i></div>
                                <h5 class="heading">Vendidos</h5>
                                <p class="text-muted text-12">{{ $rows->countItems() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(1==2)
        <section class="ul-product-detail__box">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Lista de bonificações</h4>
                                    <p>Cadastre e atualize bonificações relacionados ao produto - {{ $rows->name }}</p>
                                    <div class="card mb-5">
                                        <div class="card-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="list">
                                                        @foreach ($errors->all() as $error)
                                                            <li class="nav-item">{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="{{ route('admin.products.bonus.stores') }}" method="post">
                                                <div class="row row-xs">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $rows->id }}">
                                                    <input type="hidden" name="slug">
                                                    <div class="col-md-3">
                                                        <input name="name" class="form-control" value="{{ old('name') }}" type="text" placeholder="Nome do bunus">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input name="meta" class="form-control" type="number" placeholder="Meta" value="{{ old('meta') }}">
                                                    </div>
                                                    <div class="col-md-5 mt-3 mt-md-0">
                                                        <input name="description" class="form-control" type="text" placeholder="Bonificação" value="{{ old('description') }}">
                                                    </div>
                                                    <div class="col-md-2 mt-3 mt-md-0">
                                                        <button class="btn btn-primary btn-block">Cadastrar</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                            @if($rows->bonus->count())
                                                @foreach($rows->bonus as $bonus)
                                                <div class="card-body">
                                                    <form action="{{ route('admin.products.bonus.stores') }}" method="post">
                                                        <div class="row row-xs">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $rows->id }}">
                                                            <input type="hidden" name="id" value="{{ $bonus->id }}">
                                                            <input type="hidden" name="slug">
                                                            <div class="col-md-3">
                                                                <input name="name" class="form-control" type="text" placeholder="Nome do bunus"  value="{{ $bonus->name }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input name="meta" class="form-control" type="number" placeholder="Meta" value="{{ $bonus->meta }}">
                                                            </div>
                                                            <div class="col-md-5 mt-3 mt-md-0">
                                                                <input name="description" class="form-control" type="text" placeholder="Bonificação" value="{{ $bonus->description }}">
                                                            </div>
                                                            <div class="col-md-1 mt-3 mt-md-0">
                                                                <button class="btn btn-success btn-block"><i class="fa fa-edit"></i> </button>
                                                            </div>
                                                            <div class="col-md-1 mt-3 mt-md-0">
                                                                <a href="{{ route('admin.products.bonus.destroy', [
                                                                'product'=>$rows->id,
                                                                'bonus'=>$bonus->id
                                                                ]) }}" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                @endforeach
                                            @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </section>

@endsection

