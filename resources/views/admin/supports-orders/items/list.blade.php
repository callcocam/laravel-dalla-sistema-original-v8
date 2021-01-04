<tr>
    <th scope="row">{{ str_pad($item->id,5, '0', STR_PAD_LEFT) }}</th>
    @if(!auth()->user()->hasAnyRole('cliente'))
        <td>
            {{ $item->client->name }}
        </td>
    @endif
    <td>
        <form action="{{ route("admin.supports-order-items.destroy", $item->id ) }}" method="post"
              id="delete-{{ $item->id }}">
            @method("DELETE")
            @csrf
            <input name="id" value="{{ $item->id }}" type="hidden">
        </form>
        <form action="{{ route("admin.supports-order-items.store") }}" method="post" id="edit-{{ $item->id }}">
            @csrf
            <input name="id" value="{{ $item->id }}" type="hidden">
            <input name="support_id" value="{{ $item->support_id }}" type="hidden">
            <input name="support_order_id" value="{{ $item->support_order_id }}" type="hidden">
            <input name="amount" class="form-control" value="{{ (int)$item->amount }}" type="number" placeholder="0">
        </form>
    </td>
    @if(!$user->hasAnyRole('cliente'))
        <td>{{ form_read($item->price) }}</td>
        <td>{{ form_read($item->total) }}</td>
    @endif
    <td>
        <button class="btn btn-outline-danger delete-item" data-id="#delete-{{ $item->id }}"><i class="fa fa-trash"></i>
        </button>
        <button class="btn btn-outline-secondary update-item" data-id="#edit-{{ $item->id }}"><i
                class="fa fa-sync-alt"></i></button>
    </td>
</tr>


