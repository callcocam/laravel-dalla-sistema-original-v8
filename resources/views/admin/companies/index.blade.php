@extends('layouts.admin')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('List Companies') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row">
                <div class="col-md-12">

                    @forelse($rows as $row)

                        <div class="col-md-3 col-sm-6  ">
                            <div class="pricing">
                                <div class="title" style="display: contents">
                                    <img src="{{ $row->avatar }}" alt="">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="">
                                        <div class="pricing_features">
                                            <ul class="list-unstyled text-left">
                                                <li><i class="{{ check_status($row->name) }}"></i>  {{ __('Name') }} <strong> {{ $row->name }}</strong></li>
                                                <li><i class="{{ check_status($row->email) }}"></i>   {{ __('Email') }} <strong> {{ $row->email }}</strong></li>
                                                <li><i class="{{ check_status($row->phone) }}"></i>   {{ __('Phone') }} <strong> {{ $row->phone }}</strong></li>
                                                <li><i class="{{ check_status($row->ducument) }}"></i>   {{ __('Document') }} <strong> {{ $row->ducument }}</strong></li>
                                                <li><i class="{{ check_status($row->status) }}"></i>   {{ __('Status') }} <strong> {{ __($row->status) }}</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pricing_footer">
                                        <a href="{{ route('admin.companies.edit',$row->id) }}" class="btn btn-success btn-block" role="button"> {{ __('Edit Company') }} </a>
                                        <p>
                                            <a href="{{ route('admin.companies.destroy',$row->id) }}">Sign up</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse

                </div>
            </div>
        </div>
    </div>

@endsection


