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
    <div class="row">
        <div class="col-12">
            @include('admin.dashboard.reports.counts')
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            @include('admin.dashboard.reports.last-orders')
        </div>
        <div class="col-6">
            @include('admin.dashboard.reports.notifcations')
        </div>
    </div>

@endsection

