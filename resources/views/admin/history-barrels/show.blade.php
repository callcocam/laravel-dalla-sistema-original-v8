@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Meus barrils') }} - {{ $user->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="ul-product-detail">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section class="ul-product-detail__box">
                            <div class="row">
                                <div class="col-lg-12 mt-4 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-product-detail__border-box">
                                                <div class="ul-product-detail--icon mb-2"><i class="i-Calculator text-danger text-25 font-weight-500"></i></div>
                                                <h5 class="heading">Quantidade de barrils</h5>
                                                <p class="text-muted text-12">{{ $user->barrels }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <caption>Historico de barrils</caption>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Barrils atual</th>
                                    <th scope="col">Situação</th>
                                </tr>
                                </thead>
                                <tbody id="names">
                                <!-- --------------------------- tr1 -------------------------------------------->
                                @foreach($rows as $row)
                                    <tr>
                                        <td scope="row">{{ str_pad($row->id, 7, '0', STR_PAD_LEFT) }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

