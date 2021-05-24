@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Dashboard') }}</a></li>
            <li>{{ __('Categories') }}</li>
        </ul>
        <div style="right: 2%;position: absolute;">
            <a href="{{ route('admin.videos.create') }}" class="btn btn-success btn-rounded pull-right"><span class="icon i-Add-File"></span> {{ __('Cadastrar') }}</a>
        </div>
    </div>
@endsection
@section('content')

        @if($rows->count())

        @foreach($rows as $row)
            <div class="row">
            <div class="card mb-4 col-12">
                <div class="card-header">{{ $row->name }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $row->status }}</h5>
                    <p class="card-text">{{ $row->description }}</p>
                    <a class="btn btn-primary btn-rounded" href="{{ route('admin.videos.edit',$row->id) }}">  @include('admin.includes.icons.edit',['row'=>$row])</a>
                    @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.videos.destroy'])
                </div>
            </div>
            </div>
        @endforeach

            <div class="row">
                <div class="col-12">
                    {{ $rows->render() }}
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    @include("admin.includes.empty", [
                           'url' =>'admin.videos.create'
                       ])
                </div>
            </div>

        @endif

@endsection

@include("admin.includes.alert")
