@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Pedidos') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            @can('admin.supports-orders.create')
                <a href="{{ route('admin.supports-orders.create') }}"
                   class="btn btn-success btn-rounded btn-lg pull-right"><span
                        class="icon i-Add-Cart"></span> {{ __('Cadastrar Pedido') }}</a>
            @endcan
        </div>
    </div>
@endsection
@section('content')

    @if($rows->count())
        <div id="task-manager-list">
            <!--  content area -->
            <div class="content">
                <!--  task manager table -->
                <div class="card" id="card">

                    <div class="card-header">
                        <form class="form-inline">
                            <div class="form-row" style="width: 100%;">
                                <div class="col-md-5">
                                    <input class="form-control" name="search" id="search" type="search"
                                           placeholder="Termo de busca" aria-label="Search" style="width: 100%;">
                                </div>
                                <div class="col-md-5 mt-3 mt-md-0">
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option>==Todos==</option>
                                        <option value="not-accepted"
                                                @if($status == "not-accepted") selected @endif>==Não aceito==
                                        </option>
                                        <option value="open"
                                                @if($status == "open") selected @endif>==Abertos==
                                        </option>
                                        <option value="transit"
                                                @if($status == "transit") selected @endif>==Em transito==
                                        </option>
                                        <option value="completed"
                                                @if($status == "completed") selected @endif>==Completo==
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2 mt-3 mt-md-0">
                                    <button class="btn btn-primary btn-block">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body" id="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    @if(!auth()->user()->hasAnyRole('cliente'))
                                        <th scope="col">Cliente</th>
                                    @endif
                                    <th scope="col">Data</th>
                                    <th scope="col">Situação</th>
                                    <th scope="col">#</th>
                                </tr>
                                </thead>
                                <tbody id="names">
                                <!-- --------------------------- tr1 -------------------------------------------->
                                @foreach($rows as $row)
                                    @can('view', $row)
                                        <tr>
                                            <th scope="row">#{{ str_pad($row->id, 5, '0', STR_PAD_LEFT) }}</th>
                                            @if(!auth()->user()->hasAnyRole('cliente'))
                                                <td class="collection-item">
                                                    @if($row->client)
                                                        <div class="font-weight-bold"><a
                                                                href="{{ route('admin.clients.show', $row->client->id) }}">{{ $row->client->name }}</a>
                                                        </div>
                                                        <div class="text-muted">{{ $row->client->description }}</div>
                                                    @else
                                                        ----
                                                    @endif
                                                </td>
                                            @endif

                                            <td class="custom-align">
                                                {{ date_carbom_format($row->created_at)->format('d/m/Y') }}
                                            </td>
                                            <td class="custom-align">
                                                <span
                                                    class="badge badge-pill badge-outline-{{ check_status($row->status,['not-accepted'=>'danger','open'=>'primary','transit'=>'warning','completed'=>'success']) }} p-2 m-1">{{ check_status_text($row->status,['not-accepted'=>'Aguardando Aprovação','open'=>'Aberto','transit'=>'Em transito','completed'=>'Completo']) }}</span>
                                            </td>
                                            <td class="custom-align">
                                                @can('admin.supports-orders.edit')
                                                    @can('status', $row)
                                                        <a class="btn btn-primary btn-rounded"
                                                           href="{{ route('admin.supports-orders.edit',$row->id) }}">  @include('admin.includes.icons.edit',['row'=>$row])</a>
                                                    @endcan
                                                @endcan
                                                @can('admin.supports-orders.show')
                                                    <a class="btn btn-warning btn-rounded"
                                                       href="{{ route('admin.supports-orders.show',$row->id) }}">  @include('admin.includes.icons.show',['row'=>$row])</a>
                                                @endcan
                                                @if(!in_array($row->status, ["completed",'open','transit']))
                                                    @can('admin.supports-orders.destroy')
                                                        @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.supports-orders.destroy'])
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                    @endcan
                                @endforeach
                                <!--  end of table row 3 -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="row align-items-center">
                            <div class="col">
                                {{ $rows->render() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!--  end of task manager table -->
            </div>
            <!--  end of content area -->
        </div>
    @else
        <div class="row">
            <div class="col-12">
                @include("admin.includes.empty", [
                       'url' =>route('admin.supports-orders.create')
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
