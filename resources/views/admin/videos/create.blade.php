@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('admin.videos.index') }}">{{ __('Videos') }}</a></li>
            <li>{{ __('Create') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route'=>['admin.videos.store'],"method"=>"post"]) }}
            @csrf
            {{ Form::hidden('slug', null) }}
            {{ Form::hidden('template', true) }}
            <div class="form-group row">
                {{ Form::bsText('name', old('name'), "Name") }}
            </div>
            <div class="form-group row">
                {{ Form::bsText('origin', old('origin'), "Origem") }}
            </div>
            <div class="form-group row">
                {{ Form::bsText('size', old('size'), "Size") }}
            </div>
            <div class="form-group row">
                {{ Form::bsText('width', old('width'), "Width") }}
            </div>
            <div class="form-group row">
                {{ Form::bsText('height', old('height'), "Height") }}
            </div>
            <div class="form-group row">
                {{Form::bsRadio('status', [
                     'published'=>'Published',
                     'draft'=>'Draft',
                ], old('status'))}}
            </div>
            <hr>
            <div class="form-group row">
                {{ Form::bsTextArea('description', old('description'),'Description') }}
            </div>
            <div class="ln_solid"></div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-6 offset-md-3">

                    {{ Form::submit(__('Create Video'), [
                        'class'=>'btn btn-success btn-block'
                    ]) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
