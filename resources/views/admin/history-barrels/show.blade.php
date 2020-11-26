@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Items em comodata') }} - {{ $user->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="ul-product-detail">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Tota/Entradas</th>
                                    <th scope="col">Tota/Saidas</th>
                                </tr>
                                </thead>
                                <tbody id="names">
                                <!-- --------------------------- tr1 -------------------------------------------->
                                @foreach($user->lendings() as $row)
                                    <tr>
                                        <td scope="row">{{ $row->name }}</td>
                                        <td scope="row">{{$row->sun($row,auth()->id())}}</td>
                                        <td scope="row">{{$row->sun($row,auth()->id(), 'out')}}</td>
                                    </tr>
                                @endforeach
                                <!--  end of table row 3 -->
                                </tbody>
                            </table>
                        </div>

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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

