@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Configuração') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="card user-profile o-hidden mb-4">
        <div class="header-cover m-3" style="background-image: url({{ url($rows->cover) }});background-size: contain;background-position: top;"></div>
        <div class="card-body">

            <div class="row mb-5">
                <div class="col-md-12">
                   {!! form($form) !!}
                </div>
            </div>
        </div>
    </div>
@endsection


