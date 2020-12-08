@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.clients.index') }}">{{ __('Clientes') }}</a></li>
            <li>{{ __('Metas Dos Clientes') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @if(request()->has('search'))
                <a href="{{ route('admin.clients.index') }}" class="btn btn-warning btn-rounded pull-right"><span
                        class="icon i-Security-Block"></span> {{ __('Lista completa') }}</a>
            @endif
        </div>
    </div>
@endsection
@section('content')

    @if($rows->count())
        <div class="accordion" id="accordionExample">
            <div class="row">

                <div class="col-md-12">
                    <div class="card mt-4 mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (isset($errors) && $errors->any())
                                    <div>
                                        <div
                                            class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

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
                                        <th scope="col">Mês</th>
                                        <th scope="col">Situação</th>
                                        <th scope="col" width="200">Meta</th>
                                        <th scope="col" width="200">#</th>
                                    </tr>
                                    </thead>
                                    <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @foreach($rows as $row)
                                        <tr>
                                            <td style="vertical-align: middle">{{ $row->client->name }}</td>
                                            <td style="vertical-align: middle">{{ $row->created_at->format("M/Y") }}</td>
                                            <td style="vertical-align: middle">
                                                @include("admin.metas.progress",[
                                      'client_meta'=>$row->client->meta,
                                      'meta'=>$row->meta
                                      ])
                                            </td>
                                            <td  style="vertical-align: middle">
                                               @if(auth()->user()->hasAnyRole('cliente'))
                                                {{ $row->client->meta  }}
                                                @else
                                                    <form action="{{ route('admin.clients.update', $row->client->id) }}"
                                                          method="post" id="form-{{$row->id}}">
                                                        @method('put')
                                                        @csrf
                                                        <div class="form-group col-md-12">
                                                            <div class="input-group">
                                                                <input type="hidden" name="id"
                                                                       value="{{ $row->client->id }}">
                                                                <input type="text" name="meta" class="form-control"
                                                                       value="{{ $row->client->meta }}" placeholder="Meta">
                                                                <div class="input-group-append">
                                                                <span
                                                                    onclick="document.getElementById('form-{{$row->id}}').submit()"
                                                                    class="input-group-text badge-primary cursor-pointer"
                                                                    id="basic-addon{{$row->id}}"> <i
                                                                        class="fa fa-reply-all"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">
                                                @can('admin.metas.show')
                                                    <a class="btn btn-info btn-rounded"
                                                       href="{{ route('admin.metas.show',$row->id) }}">@include('admin.includes.icons.show')</a>
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
                        @include("admin.includes.empty")
                    </div>
                </div>
    @endif

@endsection

@include("admin.includes.alert")
