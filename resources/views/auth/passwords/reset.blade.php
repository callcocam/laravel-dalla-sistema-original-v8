@extends('layouts.auth')
@section('content')
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4">
                            <img src="{{ asset(get_tenant()->cover) }}" alt=""></div>
                        <h1 class="mb-3 text-18">{{ __('Recuperar Senha') }}</h1>
                       <div class="row">
                           <div class="col">
                               {!! form_row($form->token->setValue($token)) !!}
                               {!! form($form) !!}
                           </div>
                       </div>
                        <div class="mt-3 text-center">
                            <a class="text-muted" href="{{ route('login') }}">
                                <u>{{ __('Voltar Para A Tela De Login') }}</u>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
