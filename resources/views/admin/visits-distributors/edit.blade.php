@extends('layouts.admin')
@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.visits-distributors.index') }}">{{ __('Visitas') }}</a></li>
            <li>{{ $rows->client->name }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row mb-5">
        <div class="col-md-12">
             {!! form($form) !!}
        </div>
    </div>
 <div class="row mb-5">
     @if($rows->file)
         @foreach($rows->file()->get() as $file)
             <div class="col-lg-4 col-xl-4 mb-4">
                 <div class="card o-hidden"><img class="d-block w-100" src="{{ url($file->fullPath) }}" alt="Second slide">
                     <div class="card-footer bg-transparent">
                         <div class="row">
                             <div class="col text-center">
                                 <a href="{{ route('admin.admin.remove-file', $file->id) }}" class="btn btn-dark btn-block">{{ __('Remover Imagem') }}</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         @endforeach
     @endif
    </div>

@endsection



@push("scripts")
    <script>
        $(function () {
            $('form').change(function () {

                window.axios.post("{{ url('/visitas-ditribuidor/store-json/save') }}", $('form').serialize()).then(respone=>{
                    console.log(respone)
                })
            })
        })
    </script>
@endpush
