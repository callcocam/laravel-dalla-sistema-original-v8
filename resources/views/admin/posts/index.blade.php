@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Notificações') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.posts.create')
                <a href="{{ route('admin.posts.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')

    @if($rows->count())

        <div class="accordion" id="accordionExample">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 mb-4">
                        <div class="card-header">
                            <form class="form-inline">
                                <div class="form-row" style="width: 100%;">
                                    <div class="col-md-5">
                                        <input class="form-control" name="search" value="{{ request('search') }}"
                                               id="search" type="search" placeholder="Termo de busca"
                                               aria-label="Search" style="width: 100%;">
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <button class="btn btn-primary btn-block">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        @if(!$user->hasAnyRole('cliente'))
                                        <th scope="col">#</th>
                                        @endif
                                        <th scope="col">Name</th>
                                        @if(!$user->hasAnyRole('cliente'))
                                            <th scope="col">Visualizações</th>
                                            <th scope="col">Situação</th>
                                        @endif
                                        <th scope="col" width="200">#</th>
                                    </tr>
                                    </thead>
                                    <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @foreach($rows as $row)
                                        <tr>
                                            @if(!$user->hasAnyRole('cliente'))
                                            <td scope="row">{{ str_pad($row->id, 7, '0', STR_PAD_LEFT) }}</td>
                                            @endif
                                            <td scope="row">{{ $row->name }}</td>
                                            @if(!$user->hasAnyRole('cliente'))
                                            <td scope="row">{{ $row->views }}</td>
                                            <td scope="row"><span
                                                    class="badge badge-{{ check_status($row->status) }}">{{ check_status_text($row->status) }}</span>
                                            </td>
                                            @endif
                                            <td scope="row">
                                                @can('admin.posts.edit')
                                                    <a class="btn btn-primary btn-rounded"
                                                       href="{{ route('admin.posts.edit',$row->id) }}">@include('admin.includes.icons.edit')</a>
                                                @endcan
                                                @can('admin.posts.show')
                                                    <a class="btn btn-info btn-rounded"
                                                       href="{{ route('admin.posts.show',$row->id) }}">@include('admin.includes.icons.show')</a>
                                                @endcan
                                                @can('admin.posts.destroy')
                                                    @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.posts.destroy'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!--  end of table row 3 -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                <div class="row">
                                    <div class="col-12">
                                        {{ $rows->render() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @else
        <div class="row">
            <div class="col-12">
                @include("admin.includes.empty", [
                       'url' =>'admin.posts.create'
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
