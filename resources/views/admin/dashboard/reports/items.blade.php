<div class="d-flex flex-column flex-sm-row align-items-center mb-3">
    <div class="flex-grow-1 text-center text-sm-left">
        <h5>
            @if(auth()->user()->hasAnyRole('cliente'))
                <a href="{{ route('admin.orders.edit',$last->id) }}">#{{ str_pad($last->id,7,'0',STR_PAD_LEFT) }}</a>
            @else
                @if($last->client)
                    <a href="{{ route('admin.clients.edit',$last->client->id) }}">{{ $last->client->name }}</a>
                @endif
            @endif
        </h5>
        <p class="m-0 text-small text-muted"> {{ $last->description }} </p>
        <p class="text-small text-danger m-0"> {{ form_read($last->total) }}
            @if($last->discount)
                <del class="text-muted">{{ form_read($last->price) }}</del>
            @endif
        </p>
    </div>
    <div>
    <span class="btn btn-outline-{{ check_status($last->status,order_status_color()) }} btn-rounded btn-sm m-3 m-sm-0">
                                        {{ check_status_text($last->status,order_status()) }}</span>
        <a href="{{ route('admin.orders.edit', $last->id) }}"
           class="btn btn-outline-primary btn-rounded btn-sm m-3 m-sm-0"> Visualizar</a>
    </div>
</div>
