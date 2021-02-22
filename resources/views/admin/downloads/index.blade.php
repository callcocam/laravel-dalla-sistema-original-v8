@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Downloads') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.downloads.create')
                <a href="{{ route('admin.downloads.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar Download') }}</a>
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
                                <table class="table table-bordered align-items-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Name</th>
                                        @canany(['admin.downloads.edit','admin.downloads.show','admin.downloads.destroy'])
                                        <th scope="col" width="200">#</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @foreach($rows as $row)
                                        <tr class="align-items-center my-auto">
                                            <td class="my-auto">
                                                @if(\Illuminate\Support\Str::contains($row->type, 'image'))
                                                <a target="_blank" class="btn btn-outline-danger" href="{{ route('admin.downloads.download', $row->id) }}">
                                                    <img  height="100" src="{{ $row->cover }}" alt="{{ $row->name }}">
                                                </a>
                                                @else
                                                   {{ $row->type }}
                                                @endif
                                            </td>
                                            <td class="my-auto">
                                                <a target="_blank" class="btn btn-outline-danger" href="{{ route('admin.downloads.download', $row->id) }}">
                                                    {{ $row->name }} <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                            @canany(['admin.downloads.edit','admin.downloads.show','admin.downloads.destroy'])
                                            <td scope="row">
                                                @can('admin.downloads.edit')
                                                    <a class="btn btn-primary btn-rounded"
                                                       href="{{ route('admin.downloads.edit',$row->id) }}">@include('admin.includes.icons.edit')</a>
                                                @endcan
                                                @can('admin.downloads.destroy')
                                                    @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.downloads.destroy'])
                                                @endcan
                                            </td>
                                            @endcan
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
                       'url' =>'admin.downloads.create'
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
