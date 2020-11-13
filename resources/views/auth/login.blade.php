@extends('layouts.auth')
@section('content')
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="{{ asset(get_tenant()->cover) }}" alt=""></div>
                        <h1 class="mb-3 text-18">{{ __('Logar no Sistema') }}</h1>
                        {!! form($form) !!}
                        <div class="mt-3 text-center">
                            @if (Route::has('register'))
                            <a class="text-muted" href="{{ route('register') }}">
                                    <u>{{ __('Cadastre-se?') }}</u></a> |
                            @endif<a class="text-muted" href="{{ route('password.request') }}">
                                <u>{{ __('Esqueci minha senha?') }}</u></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
