
@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Usuários') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.users.create')
                <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar Usuário') }}</a>
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
                                        <p class="ul-task-manager__paragraph mb-3">Data: {{ date_carbom_format($row->created_at)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @if($row->roles)
                                    <ul class="list-group list-group-flash">
                                        <li class="list-group-item border-0">
                                            @foreach($row->roles as $role)
                                                @can('admin.roles.edit')
                                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="badge badge-{{ get_tag_color() }} r-badge">{{ $role->name }}</a>
                                                @endcan
                                                @cannot('admin.roles.edit')
                                                    <span class="badge badge-{{ get_tag_color() }} r-badge">{{ $role->name }}</span>
                                                @endcannot

                                            @endforeach
                                        </li>
                                    </ul>
                                @endif
                            </div>
                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                @can('admin.users.edit')
                                    <a class="btn btn-primary btn-rounded" href="{{ route('admin.users.edit',$row->id) }}">  @include('admin.includes.icons.edit',['row'=>$row])</a>
                                @endcan
                                <a class="btn btn-outline-{{ check_status($row->status) }} btn-rounded">{{  check_status_text($row->status) }}</a>
                                @can('admin.users.destroy')
                                        @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.users.destroy'])
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
                       'url' =>route('admin.users.create')
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
