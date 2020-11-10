@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Rotas Dinâmicas') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            <a href="{{ route('admin.auto-route.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Create Rotas Dinâmica') }}</a>
        </div>
    </div>
@endsection
@section('content')

    @if($rows->count())
        <div class="accordion" id="accordionExample">
            <div class="row">
                @foreach($rows as $row)
                    <div class="card m-2">
                        <div class="card-header">{{ $row->name }}</div>
                        <div class="card-body">
                            <p class="card-text">
                            <div class="card ul-card__border-radius">
                                <div class="card-header">
                                    <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                        <a  class="text-default collapsed" data-toggle="collapse"  href="#accordion-item-{{$row->id}}">
                                            <span><i class="i-Lock-User ul-accordion__font"> </i></span> {{ __("Detalhes") }}
                                        </a>
                                    </h6>
                                </div>
                                    <div class="collapse" id="accordion-item-{{$row->id}}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <table class="table text-center" id="user_table">
                                                <tbody>
                                                @if($row->route)
                                                    <tr>
                                                        <td>{{ $row->route }}</td>
                                                    </tr>
                                                @endif
                                                @if($row->verb)
                                                    <tr>
                                                        <td>{{ $row->verb }}</td>
                                                    </tr>
                                                @endif
                                                @if($row->pattern)
                                                    <tr>
                                                        <td>{{ $row->pattern }}</td>
                                                    </tr>
                                                @endif
                                                @if($row->controller)
                                                    <tr>
                                                        <td>{{ $row->controller }}</td>
                                                    </tr>
                                                @endif
                                                @if($row->method)
                                                    <tr>
                                                        <td>{{ $row->method }}</td>
                                                    </tr>
                                                @endif
                                                @if($row->middleware)
                                                    <tr>
                                                        <td>{{ $row->middleware }}</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                            </div>
                            <hr>
                            {{ $row->description }}</p>
                            <a class="btn btn-primary btn-rounded" href="{{ route('admin.auto-route.edit',$row->id) }}">{{ __('Editar Rotas Dinâmica') }}</a>
                            <a class="btn btn-primary btn-rounded" href="{{ route('admin.auto-route.show',$row->id) }}">{{ __('Excluir Rotas Dinâmica') }}</a>
                            <a class="btn btn-outline-{{ check_status($row->status) }} btn-rounded">{{ $row->status }}</a>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{ $rows->render() }}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                @include("admin.includes.empty", [
                       'url' =>route('admin.auto-route.create')
                   ])
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
