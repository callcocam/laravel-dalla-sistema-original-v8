@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.auth.profile.form') }}">{{ $user->name }}</a></li>
            <li>{{ __('Painel') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    @include('admin.dashboard.reports.counts')
    @include('admin.dashboard.reports.last-orders')
@endsection

