@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Downloads') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @if(request('search'))
                <a href="{{ route('admin.downloads.index') }}" class="btn btn-warning btn-rounded pull-right"><span
                        class="icon i-Securiy-Remove"></span> {{ __('Ver tudo') }}</a>
            @endif
            @can('admin.downloads.create')
                <a href="{{ route('admin.downloads.create') }}" class="btn btn-success btn-rounded pull-right"><span
                        class="icon i-Add-File"></span> {{ __('Cadastrar Download') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')
    @if($rows->count())
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
                        <div class="accordion" id="accordionExample">
                            @foreach($rows as $row)
                                @if($row->downloads->count())
                                    <div class="card ul-card__border-radius">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">
                                                <a class="text-default collapsed"
                                                   data-toggle="collapse"
                                                   href="#accordion-item-group{{ $row->id }}"
                                                   aria-expanded="false"> {{ $row->name }}</a></h6>
                                        </div>
                                        <div class="collapse" id="accordion-item-group{{ $row->id }}"
                                             data-parent="#accordionExample"
                                             style="">
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
                                                        @foreach($row->downloads as $download)
                                                            <tr class="align-items-center my-auto">
                                                                <td class="my-auto">
                                                                    @if($download->download)
                                                                        @if(\Illuminate\Support\Str::contains($download->download->fileType, 'image'))
                                                                            <a target="_blank"
                                                                               class="btn btn-outline-danger"
                                                                               href="{{ route('admin.downloads.download', $download->id) }}">
                                                                                <img height="100"
                                                                                     src="{{ $download->cover }}"
                                                                                     alt="{{ $download->name }}">
                                                                            </a>
                                                                        @else
                                                                            {{ $download->download->fileType }}
                                                                        @endif
                                                                    @else
                                                                        Nenhum resultado
                                                                    @endif
                                                                </td>
                                                                <td class="my-auto">
                                                                    <a target="_blank" class="btn btn-outline-danger"
                                                                       href="{{ route('admin.downloads.download', $download->id) }}">
                                                                        {{ $download->name }} <i
                                                                            class="fa fa-download"></i>
                                                                    </a>
                                                                </td>
                                                                @canany(['admin.downloads.edit','admin.downloads.show','admin.downloads.destroy'])
                                                                    <td scope="row">
                                                                        @can('admin.downloads.edit')
                                                                            <a class="btn btn-primary btn-rounded"
                                                                               href="{{ route('admin.downloads.edit',$download->id) }}">@include('admin.includes.icons.edit')</a>
                                                                        @endcan
                                                                        @can('admin.downloads.destroy')
                                                                            @include('admin.includes.icons.destroy',['row'=>$download, 'route'=>'admin.downloads.destroy'])
                                                                        @endcan
                                                                    </td>
                                                                @endcan
                                                            </tr>
                                                        @endforeach
                                                        <!--  end of table row 3 -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
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
