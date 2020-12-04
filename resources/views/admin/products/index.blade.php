@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Produtos') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.products.create')
                <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar Produto Evento') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')

    @if($rows->count())

        <section class="product-cart">
            <div class="row list-grid">
                @foreach($rows as $row)
                <div class="list-item col-md-4">

                    <div class="card o-hidden mb-4 d-flex flex-column">
                        <div class="list-thumb d-flex"><img alt="{{ $row->name }}" src="{{ asset($row->cover) }}"></div>
                        <div class="flex-grow-1 d-bock">
                            <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center"><a class="w-40 w-sm-100" href="{{ route('admin.products.edit',$row->id) }}">
                                    <div class="item-title">
                                        {{ $row->name }}
                                    </div>
                                </a>
                                <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges"><span class="badge badge-{{ check_status($row->status) }}">{{  check_status_text($row->status) }}</span></p>
                                <div class="clearfix"></div>
                                <p class="m-0 ml-48 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges"><span class="badge badge-info">{{ $row->stock }}</span></p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col text-center">
                                        @can('admin.products.edit')
                                            <a class="btn btn-warning btn-rounded text-cyan-50" href="{{ route('admin.products.edit',$row->id) }}">
                                                @include('admin.includes.icons.edit',['row'=>$row])
                                            </a>
                                        @endcan
                                    </div>
                                    <div class="col text-center">
                                        @can('admin.products.show')
                                            <a class="btn btn-success btn-rounded" href="{{ route('admin.products.show',$row->id) }}">
                                                @include('admin.includes.icons.show',['row'=>$row])</a>
                                        @endcan
                                    </div>
                                    <div class="col text-center">
                                        @can('admin.products.destroy')
                                            @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.products.destroy'])
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>


        <div class="row">
            <div class="col-12">
                {{ $rows->render() }}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                @include("admin.includes.empty", [
                       'url' =>'admin.products.create'
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
