@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Visitas Distribuidors') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.visits-distributors.create')
                <a href="{{ route('admin.visits-distributors.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')

    @if($rows->count())
        <div class="accordion" id="accordionExample">
            <div class="row">
                @foreach($rows as $row)

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card mt-4 mb-4">
                            <div class="card-body">
                                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                    <div>
                                        <h5>{{ $row->client->name }}</h5>
                                        <p class="ul-task-manager__paragraph mb-3"> {{ $row->resbonsible }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                @can('admin.visits-distributors.edit')
                                    <a class="btn btn-primary btn-rounded" href="{{ route('admin.visits-distributors.edit',$row->id) }}">  @include('admin.includes.icons.edit',['row'=>$row])</a>
                                @endcan
                                <a href="{{ route('admin.visits-distributors.show',$row->id) }}" class="btn btn-dark btn-rounded">  @include('admin.includes.icons.show',['row'=>$row])</a>
                                @can('admin.visits-distributors.show')
                                        @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.visits-distributors.destroy'])
                                @endcan
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{ $rows->render() }}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                @include("admin.includes.empty", [
                       'url' =>'admin.visits-distributors.create'
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
