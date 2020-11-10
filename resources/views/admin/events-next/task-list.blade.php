@extends('layouts.admin')

@section('breadcrumb')
    <div class="breadcrumb">
        <h1>{{ $tenant->name }}</h1>
        <ul>
            <li><a href="{{ route('admin.admin.index') }}">{{ __('Painel') }}</a></li>
            <li><a href="{{ route('admin.events-next.index') }}">{{ __('Eventos') }}</a></li>
            <li>{{ __('Tarefas') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    @if($rows)
        @foreach($rows->task as $row)
            @isset($row->task->slug)
                <form class="" action="{{ route("admin.tasks-next.update", $row->event_id) }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $row->id }}" name="{{ $row->task->slug }}[id]">
                    <input type="hidden" value="{{ $row->name }}" name="{{ $row->task->slug }}[name]">
                    <input type="hidden" value="{{ $row->task_id }}" name="{{ $row->task->slug }}[task_id]">
                    <input type="hidden" value="{{ $user->id }}" name="{{ $row->task->slug }}[updated_by]">
                    <div class="item">
                        <div class="mt-4 border border-primary pt-3 pr-3 pl-3 pb-1">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $row->task->name }}: <b>{{ $row->name }}</b><br/>
                                    Descrição: <b>{{ $row->description }}</b>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="radio radio-outline-danger">
                                            <input @if($row->status == "draft") checked @endif type="radio" value="draft" name="{{ $row->task->slug }}[status]"><span>A FAZER</span><span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-outline-success">
                                            <input @if($row->status == "published") checked @endif type="radio" value="published" name="{{ $row->task->slug }}[status]"><span>FEITO</span><span class="checkmark"></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    @can('admin.tasks-next.delete')

                                        <div class="ul-todo-action d-flex align-items-rigth">
                                            <button type="button" class="btn bg-transparent _r_btn border-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="_dot _r_block-dot bg-dark"></span>
                                                <span class="_dot _r_block-dot bg-dark"></span>
                                                <span class="_dot _r_block-dot bg-dark"></span>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(296px, 50px, 0px);">
                                                <a href="{{ route('admin.tasks-next.delete', $row->id) }}" class="btn btn-danger btn-outline-danger btn-block delete-tarefa">Excluir Tarefa</a>
                                            </div>
                                        </div>

                                    @endcan
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <textarea class="form-control" name="{{ $row->task->slug }}[observations]" rows="3" placeholder="Informações adicionais">{{ $row->observations }}</textarea>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            @endisset
        @endforeach
        @if($rows->task->count())
            <div class="row">
                <div class="col-md-12">
                    <a target="_blank" href="{{ route('admin.events-next.print', $rows->id) }}" class="btn btn-gray-300 btn-block mb-5"><i class="icon i-Finger-Print"></i> Imprimir Tarefas</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    @include("admin.includes.empty", [
                           'back' =>route('admin.events-next.index')
                       ])
                </div>
            </div>
        @endif
    @endif

@endsection

@include("admin.includes.alert")

@push("scripts")
    <script>
        $(function () {
            $('form').change(function (e) {
                window.axios.post($(this).attr('action'), $(this).serialize()).then(respone=>{
                    // window.location.reload()
                })
            })
        })
    </script>
@endpush

@push("scripts")
    <script>
        $(function () {
            $('form').change(function () {

                window.axios.post($(this).attr('action'), $(this).serialize()).then(respone=>{
                    ///window.location.reload();
                })
            })

            $('.delete-tarefa').click(function () {
                var r = confirm("Confirmar a operação!");
                if (r == true) {
                    window.axios.delete($(this).attr('href')).then(respone=>{
                        window.location.reload();
                    })
                } else {
                    return false;
                }

            })
        })
    </script>
@endpush