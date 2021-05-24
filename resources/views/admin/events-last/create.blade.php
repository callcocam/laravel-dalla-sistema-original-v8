@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.events-last.index') }}">{{ __('Últimos Eventos') }}</a></li>
            <li>{{ __('Cadastrar') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row mb-5">
        <div class="col-md-12">
            {!! form($form) !!}
        </div>
    </div>
@endsection


@push("scripts")
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'description' );
        CKEDITOR.replace( 'observations' );
        CKEDITOR.replace( 'pre_checklist' );
    </script>
@endpush
