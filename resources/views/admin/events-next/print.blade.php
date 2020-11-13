
<div id="print-area">
    <h1 style="width: 100%; text-align: center">{{ $rows->name }}</h1>
    @if($rows->client)
        <div  style="width: 100%; text-align: left"><b>Cliente: </b>{{ $rows->client->name }}</div>
        <div  style="width: 100%; text-align: left"><b>Telefone: </b>{{ $rows->client->phone }}</div>
    @endif
        <div  style="width: 100%; text-align: left"><b>Contato: </b>{{ $rows->contractor }}</div>
        <div  style="width: 100%; text-align: left"><b>Valor do Chopp: </b>{{ $rows->chopp_price }}</div>
        <div  style="width: 100%; text-align: left"><b>Local: </b>{{ $rows->local }}</div>
        <div  style="width: 100%; text-align: left"><b>Distância: </b>{{ $rows->distance }}</div>
        <div  style="width: 100%; text-align: left"><b>Caminhão: </b>{{ $rows->trucks }}</div>
        <div  style="width: 100%; text-align: left"><b>Motorista: </b>{{ $rows->truck_driver }}</div>
        <div  style="width: 100%; text-align: left"><b>Equipe: </b>{{ $rows->team }}</div>
        <div  style="width: 100%; text-align: left"><b>Descrição do Evento: </b>{!! $rows->description !!}</div>
        <div  style="width: 100%; text-align: left"><b>Observações do Evento: </b>{!! $rows->observations !!}</div>


    <h2>CHECKLIST</h2>
    @if($rows->task->count())
        @foreach($rows->task as $row)
            @isset($row->task->slug)
            <div class="item">
                <div class="border pt-3 pr-3 pl-3 pb-1">
                    <div class="row">
                        <div class="col-md-12">
                            {{ $row->task->name }}: <b>{{ $row->name }}</b><br/>
                            Descrição: <b>{{ $row->description }}</b>
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
                <hr>
            </div>
            @endisset
        @endforeach
    @endif
</div>