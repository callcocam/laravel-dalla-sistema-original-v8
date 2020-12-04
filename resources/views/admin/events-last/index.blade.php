@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Events') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.events-last.create')
                <a href="{{ route('admin.events-last.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar Evento') }}</a>
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
                                        <h5>{{ $row->name }}</h5>
                                        @if($row->client()->count())
                                        <p class="ul-task-manager__paragraph mb-1"><b>Contratante:</b> </p>
                                        <p class="ul-task-manager__paragraph mb-3"> {{ $row->client->name }}</p>
                                        @endif
                                        <p class="ul-task-manager__paragraph mb-3">Data: {{ date_carbom_format($row->start_event)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @if($row->task->count())
                                    @can('admin.tasks-last.list')
                                        <a href="{{ route('admin.tasks-last.list',$row->id) }}" class="btn btn-outline-primary btn-block"><i class="ul-task-manager__fonts i-Tablet-Secure"></i> Listar tarefas</a>
                                    @endcan
                                @endif
                                @can('admin.tasks-last.index')
                                    <a href="{{ route('admin.tasks-last.index',$row->id) }}" class="btn btn-outline-primary btn-block"><i class="ul-task-manager__fonts i-Edit"></i> Gerenciar tarefas</a>
                                @endcan
                            </div>
                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                @can('admin.events-last.edit')
                                    <a class="btn btn-primary btn-rounded" href="{{ route('admin.events-last.edit',$row->id) }}">  @include('admin.includes.icons.edit',['row'=>$row])</a>
                                @endcan
                                @can('admin.events-last.show')
                                    <a class="btn btn-warning btn-rounded" href="{{ route('admin.events-last.show',$row->id) }}">  @include('admin.includes.icons.show',['row'=>$row])</a>
                                @endcan
                                @can('admin.events-last.destroy')
                                        @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.events-last.destroy'])
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
                       'url' =>'admin.events-last.create'
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
