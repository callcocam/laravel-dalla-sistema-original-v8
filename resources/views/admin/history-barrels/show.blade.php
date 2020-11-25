@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Movimentação') }} - {{ $user->name }}</li>
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
                                                <h5 class="heading">Quantidade</h5>
                                                <p class="text-muted text-12">{{ $count_moviment }}</p>
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
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Saida/Entrada</th>
                                    <th scope="col">Quantidade</th>
                                </tr>
                                </thead>

                                <!-- --------------------------- tr1 -------------------------------------------->
                                @if($rows)
                                    <tbody id="names">
                                    @foreach($rows as $row)
                                        <tr>
                                            <td scope="row">{{ $row->created_at->format('d/m/Y') }}</td>
                                            <td scope="row">{{ $row->lending->name }}</td>
                                            <td scope="row"> <span class="badge badge-{{ check_status($row->type,['in'=>'success','out'=>'danger']) }}">
                                                    {{ check_status_text($row->type,['in'=>'Entrada','out'=>'Saida']) }}</span></td>
                                            <td scope="row">{{ $row->quantity }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                                <!--  end of table row 3 -->
                               <tfoot>
                               <tr>
                                   <th scope="row" colspan="3">Total</th>
                                   <th scope="row">{{ $count_moviment }}</th>
                               </tr>
                               </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

