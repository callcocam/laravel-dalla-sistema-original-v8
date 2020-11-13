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
<div class="row mb-5">
    <div class="col-md-12">
        {!! form($form) !!}
    </div>
</div>
@endsection

@include("admin.includes.alert")

@push("scripts")
    <script>
        $(function () {
            $('form').change(function () {

                window.axios.post($(this).attr('action'), $(this).serialize()).then(respone=>{
                    ///window.location.reload();
                })
            })

            $('.delete-tarefa').click(function () {
                var r = confirm("Confirmar a operação!");
                if (r == true) {
                    window.axios.delete($(this).data('action')).then(respone=>{
                        window.location.reload();
                    })
                } else {
                    return false;
                }

            })
        })
    </script>
@endpush
