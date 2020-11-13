
    <div id="print-area">
    @if($rows->task->count())
        @foreach($rows->task as $row)
            <div class="item">
                <div class="border pt-3 pr-3 pl-3 pb-1">
                    <div class="row">
                        <div class="col-md-12">
                            {{ $row->task->name }}: <b>{{ $row->name }}</b><br/>
                            Descrição: <b>{{ $row->description }}</b><br/>
                            Situação: <b><span class="badge badge-pill badge-{{ check_status($row->status) }} p-2 m-1">{{ check_status_text($row->status,[
        'published'=>"Feito", 'draft'=>"A Fazer"
    ]) }}</span></b>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <label class="form-group">
                                {{ $row->observations }}
                            </label>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>