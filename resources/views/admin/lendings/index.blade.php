@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Comodatas') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @if(request()->has('search'))
                <a href="{{ route('admin.lendings.index') }}" class="btn btn-warning btn-rounded pull-right"><span
                        class="icon i-Security-Block"></span> {{ __('Lista completa') }}</a>
            @endif
            @can('admin.lendings.create')
                <a href="{{ route('admin.lendings.create') }}" class="btn btn-success btn-rounded pull-right"><span
                        class="icon i-Add-File"></span> {{ __('Cadastrar') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')
    @if($rows->count())
        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 mb-4">
                        @include('admin.includes.search')
                        <div class="card-body">
                            @if(auth()->user()->hasAnyRole('cliente'))
                                @include('admin.lendings.client')
                            @else
                                @include('admin.lendings.admin')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Data</th>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Saida/Entrada</th>
                                    </tr>
                                    </thead>
                                    <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @if($user->movimentsAll())
                                        @foreach($user->movimentsAll() as $row)
                                            <tr>
                                                <td scope="row">{{ $row->created_at->format('d/m/Y') }}</td>
                                                <td scope="row">{{ $row->lending->name }}</td>
                                                <td scope="row">{{ $row->type }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <!--  end of table row 3 -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-12">
                        @include("admin.includes.empty", [
                               'url' =>'admin.lendings.create',
                               'back' =>'admin.lendings.index',
                           ])
                    </div>
                </div>
    @endif
@endsection
@include("admin.includes.alert")
