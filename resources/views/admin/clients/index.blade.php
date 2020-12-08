@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Clientes') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @if(request()->has('search'))
                <a href="{{ route('admin.clients.index') }}" class="btn btn-warning btn-rounded pull-right"><span
                        class="icon i-Security-Block"></span> {{ __('Lista completa') }}</a>
            @endif
                @can('admin.metas.index')
                    <a href="{{ route('admin.metas.index') }}" class="btn btn-warning btn-rounded pull-right"><span
                            class="icon i-Bar-Chart"></span> {{ __('Visualizar metas') }}</a>
                @endcan
            @can('admin.clients.create')
                <a href="{{ route('admin.clients.create') }}" class="btn btn-success btn-rounded pull-right"><span
                        class="icon i-Add-File"></span> {{ __('Cadastrar Cliente Evento') }}</a>
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
                                    <div class="col-md-5 mt-3 mt-md-0">
                                        <select class="form-control" name="status" style="width: 100%;">
                                            <option value="">==Todos==</option>
                                            <option value="published"
                                                    @if($status == "published") selected @endif>==Ativo==
                                            </option>
                                            <option value="draft"
                                                    @if($status == "draft") selected @endif>==Inativo==
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <button class="btn btn-primary btn-block">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                @if (isset($errors) && $errors->any())
                                    <div>
                                        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    @if (session()->has('success'))
                                       <div class="alert alert-success">
                                           {{ session()->get('success') }}
                                       </div>
                                    @endif
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">E-Mail</th>
                                        <th scope="col">Situação</th>
                                        <th scope="col">Meta</th>
                                        <th scope="col" width="200">#</th>
                                    </tr>
                                    </thead>
                                    <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @foreach($rows as $row)
                                        <tr>
                                            <td scope="row">{{ $row->name }}</td>
                                            <td scope="row">{{ $row->email }}</td>
                                            <td scope="row"><span
                                                    class="badge badge-{{ check_status($row->status) }}">{{ check_status_text($row->status) }}</span>
                                            </td>
                                            <td scope="row">

                                                <form action="{{ route('admin.clients.update', $row->id) }}" method="post" id="form-{{$row->id}}">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-group col-md-12">
                                                        <div class="input-group mb-3">
                                                            <input type="hidden" name="id"  value="{{ $row->id }}">
                                                            <input type="text" name="meta" class="form-control" value="{{ $row->meta }}" placeholder="Meta">
                                                            <div class="input-group-append">
                                                                <span onclick="document.getElementById('form-{{$row->id}}').submit()" class="input-group-text badge-primary cursor-pointer"
                                                                      id="basic-addon{{$row->id}}"> <i
                                                                        class="fa fa-reply-all"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td scope="row">
                                                @can('admin.clients.edit')
                                                    <a class="btn btn-primary btn-rounded"
                                                       href="{{ route('admin.clients.edit',$row->id) }}">@include('admin.includes.icons.edit')</a>
                                                @endcan
                                                @can('admin.clients.show')
                                                    <a class="btn btn-info btn-rounded"
                                                       href="{{ route('admin.clients.show',$row->id) }}">@include('admin.includes.icons.show')</a>
                                                @endcan
                                                @can('admin.clients.destroy')
                                                    @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.clients.destroy'])
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
                               'url' =>'admin.clients.create',
                               'back' =>'admin.clients.index',
                           ])
                    </div>
                </div>
    @endif

@endsection

@include("admin.includes.alert")
