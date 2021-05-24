@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.metas.index') }}">{{ __('Meta') }}</a></li>
            <li>{{ __('Visualizar Meta') }} - {{ $rows->client->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">

        <div class="col-12">
            <div class="card mb-4">
                <div
                    class="card-header">{{ $rows->client->name }} você
                    atingiu {{ progress($rows->client->meta,$rows->meta) }}% de sua meta para o mês
                    de {{ month_name($rows->created_at->format("m")) }}/{{ $rows->created_at->format("Y") }}</div>
                <div class="card-body">
                    <div class="card text-left">
                        <div class="card-body">
                            <div class="progress mb-3">
                                @include("admin.metas.progress",[
                                    'client_meta'=>$rows->client->meta,
                                    'meta'=>$rows->meta
                                    ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

