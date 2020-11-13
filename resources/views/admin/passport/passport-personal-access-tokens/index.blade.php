@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li>{{ __('Passaport personal access tokens') }}</li>
        </ul>
    </div>
@endsection
@section('content')

    <passport-personal-access-tokens />

@endsection
