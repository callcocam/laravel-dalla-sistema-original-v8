@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.events-last.index') }}">{{ __('Eventos') }}</a></li>
            <li>{{ __('Tarefas') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    @if($rows)
        @foreach($rows->task as $row)
            <div class="item">
                <div class="border pt-3 pr-3 pl-3 pb-1">
                    <div class="row">
                        <div class="col-md-12">
                            {{ $row->task->name }}: <b>{{ $row->name }}</b><br/>
                            Descrição: <b>{{ $row->description }}</b><br/>
                            Situação: <b><span class="badge badge-pill badge-{{ check_status($row->status) }} p-2 m-1">{{ check_status_text($row->status,[
        'published'=>"Feito", 'draft'=>"A Fazer"
    ]) }}</span></b>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <label class="form-group">
                                {{ $row->observations }}
                            </label>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.events-last.print', $rows->id) }}" class="btn btn-gray-300 btn-block mb-5"><i class="icon i-Finger-Print"></i> Imprimir Tarefas</a>
            </div>
        </div>
    @endif

@endsection

@include("admin.includes.alert")