@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Históricos de barrils') }}</li>
        </ul>
    </div>
@endsection
@section('content')

    @if($rows->count())
        <div class="accordion" id="accordionExample">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 mb-4">
                        <div class="card-header">

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Barrils atual</th>
                                        <th scope="col">Situação</th>
                                    </tr>
                                    </thead>
                                    <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @foreach($rows as $row)
                                        <tr>
                                            <td scope="row">{{ str_pad($row->id, 7, '0', STR_PAD_LEFT) }}</td>
                                            <td scope="row">{{ $row->client->name }}</td>
                                            <td scope="row">{{ $row->quantity }}</td>
                                            <td scope="row">
                                                <span class="badge badge-{{ check_status($row->type,['in'=>'success','out'=>'danger']) }}">
                                                    {{ check_status_text($row->type,['in'=>'Entrada','out'=>'Saida']) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!--  end of table row 3 -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                                <div class="row">
                                    <div class="col-12">
                                        {{ $rows->render() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-12">
                        @include("admin.includes.empty")
                    </div>
                </div>

    @endif

@endsection
