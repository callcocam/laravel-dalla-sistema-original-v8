<tr>
    <th scope="row">{{ str_pad($item->id,5, '0', STR_PAD_LEFT) }}</th>
    <td>
        {{ $item->products->name }}
    </td>
    <td>
        <form action="{{ route("admin.items.destroy", $item->id ) }}" method="post" id="delete-{{ $item->id }}">
            @method("DELETE")
            @csrf
            <input name="id" value="{{ $item->id }}" type="hidden">
        </form>
        <form action="{{ route("admin.items.store") }}" method="post" id="edit-{{ $item->id }}">
            @csrf
            <input name="id" value="{{ $item->id }}" type="hidden">
            <input name="order_id" value="{{ $item->order_id }}" type="hidden">
            <input name="product_id" value="{{ $item->product_id }}" type="hidden">
            <input name="amount" class="form-control" value="{{ (int)$item->amount }}" type="number" placeholder="0">
        </form>
    </td>
    @if(!$user->hasAnyRole('cliente'))
        <td>{{ form_read($item->price) }}</td>
        <td>{{ form_read($item->total) }}</td>
    @endif
    <td>
        <button class="btn btn-outline-danger delete-item" data-id="#delete-{{ $item->id }}" ><i class="fa fa-trash"></i></button>
        <button class="btn btn-outline-secondary update-item" data-id="#edit-{{ $item->id }}"><i class="fa fa-sync-alt"></i> </button>
    </td>
</tr>


