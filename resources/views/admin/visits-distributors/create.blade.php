@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.visits-distributors.index') }}">{{ __('Visitas') }}</a></li>
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
    <script>
        $(function () {
            $('form').change(function () {

                window.axios.post("{{ url('/visitas-ditribuidor/store-json/save') }}", $('form').serialize()).then(respone=>{
                    window.location.href = respone.data.redirect
                })
            })
        })
    </script>
@endpush
