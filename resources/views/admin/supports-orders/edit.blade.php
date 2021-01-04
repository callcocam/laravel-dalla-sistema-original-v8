@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.supports-orders.index') }}">{{ __('Pedido') }} </a></li>
            <li>{{ str_pad($rows->id, 7, '0', STR_PAD_LEFT) }} - {{ __('Atualizar') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    @if($rows->client_id)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('admin.supports-orders.items.new')
                        <div class="col-md-12 table-responsive">
                            <table class="table table-hover mb-3">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('Nome Do Produto') }}</th>
                                    <th scope="col">{{ __('Quantidade') }}</th>
                                    @if(!$user->hasAnyRole('cliente'))
                                        <th scope="col">{{ __('Valor Unit.') }}</th>
                                        <th scope="col">{{ __('Total') }}</th>
                                    @endif
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rows->items()->get() as $item)
                                    @include('admin.supports-orders.items.list', [
                                    'item'=>$item
                                    ])
                                @empty

                                    <tr>
                                        <th scope="row" colspan="6">Não a items para o pedido corrente</th>
                                    </tr>

                                @endforelse

                                </tbody>
                            </table>

                        </div>
                        {{--                        <div class="col-md-12">--}}
                        {{--                            @include('admin.supports-orders.total')--}}
                        {{--                        </div>--}}
                    </div>

                </div>
            </div>
        </div>
    @endif
    <div class="row mt-5">
        <!-- ====  NÃO COLOCAR A LISTA DE ITEMS DE PEDIDO DENTRO DO FORMULARIO NÃO SABERIA DIZER QUAL SERIA O COMPORTAMENTO =====-->
        <div class="col-md-12">
            <!-- ==== Edit Area =====-->
            {!! form_start($form) !!}
            {!! form_row($form->number) !!}
            {!! form_row($form->id) !!}


            <div class="mt-3 mb-4 border-top"></div>
            <div class="row mb-5">

                @if($user->hasAnyRole('cliente'))
                    <div class="col-md-12">
                        {!! form_row($form->client_id) !!}
                    </div>
                @else
                    <div class="col-md-12">
                        <h5 class="font-weight-bold">{{ __("Selecione um cliente") }}</h5>
                        {!! form_row($form->client_id) !!}
                    </div>
            @endif
            <!-- NÂO ESTOU USANDO -->
                <div class="col-md-12">
                    {!! form_row($form->description) !!}
                </div>

                <div class="col-md-12">
                    <label class="d-block text-12 text-muted">{{ __('Situação do pedido') }}</label>
                    <div class="pr-0 mb-4">
                        {!! form_row($form->status) !!}
                    </div>
                </div>
            </div>
            <div class="d-flex mb-5"><span class="m-auto"></span>
                <button class="btn btn-success btn-lg"><i class="fa fa-save"></i> {{ __('Atualizar Pedido') }}</button>
            </div>
            {!! form_end($form) !!}

        </div>
    </div>
@endsection

@push("styles")
    <link href="{{ asset('/_dist/admin/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/_dist/admin/css/select2-bootstrap4.css') }}" rel="stylesheet"/>
@endpush

@push("scripts")
    <script src="{{ asset('/_dist/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('/_dist/admin/js/i18n/pt-BR.js') }}"></script>
    <script>
        $(function () {

            $(".delete-item").click(function (e) {

                $($(this).data('id')).submit()

            })
            $(".update-item").click(function () {

                $($(this).data('id')).submit()
            })
            /*$('.products').select2({
                        ajax: {
                            url: "{{ route('admin.products.find') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                theme: 'bootstrap4',
                language: "pt-BR",
                placeholder: "==Selecione Um produto==",

            });*/


        });
    </script>
@endpush

