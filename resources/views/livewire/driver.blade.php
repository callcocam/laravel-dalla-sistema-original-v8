<div>
    @if($rows)
        <div class="accordion" id="accordionExample">
            <div class="row">
                @foreach($rows as $row)
                    <div class="col-sm-6 col-xs-12">
                        <div class="card mt-4 mb-4">
                            <div class="card-body">
                                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                    <div>
                                        <h5>{{ $row->client->name }}</h5>
                                        <p class="ul-task-manager__paragraph mb-3">
                                            Data: {{ date_carbom_format($row->created_at)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @if($row->items)
                                    <ul class="list-group list-group-flash">
                                        @foreach($row->items as $item)
                                            <li class="list-group-item m-0 p-0 border-bottom-dotted-gray-600">
                                                ( {{ str_pad($item->products->id, 7, '0', STR_PAD_LEFT) }} )  {{$item->products->name}} / {{$item->amount}}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="card-footer d-block d-lg-flex justify-content-sm-between align-items-sm-center">
                                @can('admin.drivers.index')
                                    @if($selectedRow && $selectedRow->id == $row->id)
                                    <button class="btn btn-danger btn-rounded" wire:click="update()">Confirmar a operação</button>
                                   @else
                                    <button class="btn btn-{{ check_status($row->status, order_status_color()) }} btn-rounded" wire:click="confirmed({{$row}})">{{ check_status_text($row->status, order_status_driver()) }}</button>
                                    @endif
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{ $rows->render() }}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                @include("admin.includes.empty")
            </div>
        </div>
    @endif
</div>
