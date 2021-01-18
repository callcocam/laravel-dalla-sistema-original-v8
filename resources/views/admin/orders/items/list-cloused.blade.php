<tr>
    <th scope="row">{{ str_pad($item->id,5, '0', STR_PAD_LEFT) }}</th>
    <td>
        {{ $item->products->name }}
    </td>
    <td>
        {{ (int)$item->amount }}
    </td>
    @if(!$user->hasAnyRole('cliente'))
        <td>{{ form_read($item->price) }}</td>
        <td>{{ form_read($item->total) }}</td>
    @endif
</tr>


