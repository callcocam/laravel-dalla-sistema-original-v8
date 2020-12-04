@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.posts.index') }}">{{ __('Todas') }}</a></li>
            <li>{{ __('Notificações') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    @if($rows)
        @foreach($rows as $row)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">{{ $row->name }}</div>
                        <div class="card-body">

                            {!! $row->description !!}

                        </div>
                        <div class="card-footer">

                            <a class="btn btn-danger btn-rounded"
                               href="{{ route('admin.admin.index') }}">{{ __('Voltar Para Dashboard') }}</a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
