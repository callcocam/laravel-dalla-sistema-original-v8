@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.roles.index') }}">{{ __('Usuário') }}</a></li>
            <li>{{ __('Excluir Usuário') }} - {{ $rows->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">

       <div class="col-12">
           <div class="card mb-4">
               <div class="card-header">{{ $rows->name }}</div>
               <div class="card-body">
                   <form action="{{ route('admin.users.destroy',$rows->id) }}" method="POST">
                       @csrf
                       @method("DELETE")
                       <button class="btn btn-warning btn-rounded">{{ __('Excluir Usuário') }}</button>
                       <a class="btn btn-danger btn-rounded" href="{{ route('admin.users.index') }}">{{ __('Voltar Usuários') }}</a>
                   </form>
               </div>
           </div>
       </div>

    </div>

@endsection

