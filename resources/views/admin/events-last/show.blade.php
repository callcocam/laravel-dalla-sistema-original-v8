@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.events-last.index') }}">{{ __('Eventos') }}</a></li>
            <li>{{ __('Evento') }} - {{ $rows->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mt-4 mb-4">
            <div class="card">
                <div class="card-header"><h3>{{ $rows->name }}</h3></div>
                <div class="card-body">
                    <!-- begin::widget-stats-1 -->
                    <div class="ul-widget1">
                        <div class="ul-widget__item">
                            <div class="ul-widget__info">
                                <h3 class="ul-widget1__title">{{ __('Contratante:') }}</h3>
                                <span class="ul-widget__desc text-mute">{!! $rows->contractor !!}</span>
                            </div>
                        </div>
                        <div class="ul-widget__item">
                            <div class="ul-widget__info">
                                <h3 class="ul-widget1__title">{{ __('Observações:') }}</h3>
                                <span class="ul-widget__desc text-mute">{!! $rows->observations !!}</span>
                            </div>
                        </div>
                        <div class="ul-widget__item">
                            <div class="ul-widget__info">
                                <h3 class="ul-widget1__title">{{ __('Pre-Checklist:') }}</h3>
                                <span class="ul-widget__desc text-mute">{!! $rows->pre_checklist !!}</span>
                            </div>
                        </div>
                    </div>
                    <!-- end::widget-stats-1 -->
                    <div class="accordion" id="accordionExample">
                        <div class="card ul-card__border-radius">
                            <div class="collapse" id="accordion-item-group1" data-parent="#accordionExample" style="">
                                <div class="card-body">
                                   <pos-event-form-component route="{{ route('admin.pos-events-last.store') }}" :event="{{ $rows->pos_eventJson() }}"></pos-event-form-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-success" href="{{ route('admin.events-last.index') }}">{{ __('Vpltar P/ Os Eventos') }}</a>
                    <a class="btn btn-primary" href="{{ route('admin.events-last.edit', $rows->id) }}">{{ __('Editar Evento') }}</a>
                    <a class="btn btn-dark collapsed" data-toggle="collapse" href="#accordion-item-group1" aria-expanded="false">{{ __('PESQUISA POS EVENTO') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

