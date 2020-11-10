@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Dashboard') }}</a></li>
            <li>{{ __('Translate') }}</li>
        </ul>
    </div>
@endsection
@section('content')

    @if($rows)
        <div class="accordion" id="accordionExample">
            <div class="row">
                @foreach($rows as $key => $row)
                    <div class="card m-2">
                        <div class="card-header">{{ $key }}</div>
                        <div class="card-body">
                            <p class="card-text">
                            <div class="card ul-card__border-radius">
                                @if(is_string($row))
                                    <div class="d-flex flex-column">
                                        <form action="{{ route('admin.translate.index') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input name="key" class="form-control" type="text" placeholder="{{ __('Key') }}" value="{{ $key }}">
                                            </div>
                                            <div class="form-group">
                                                <input name="value" class="form-control" type="text" placeholder="{{ __('Translate') }}" value="{{ $row }}">
                                            </div>
                                            <button class="btn btn-primary pd-x-20">{{ __('Edit Translate') }}</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                @include("admin.includes.empty")
            </div>
        </div>

    @endif

@endsection

@include("admin.includes.alert")
