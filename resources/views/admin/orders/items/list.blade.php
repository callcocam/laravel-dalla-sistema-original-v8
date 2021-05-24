<tr>
    <th scope="row">{{ str_pad($item->id,5, '0', STR_PAD_LEFT) }}</th>
    <td>
        {{ $item->products->name }}
    </td>
    <td>
        {{ $item->amount }}
    </td>
    <td>
        <input wire:model="current.{{$item->id}}.amount" name="amount" class="form-control" type="number"
               min="0" placeholder="0" autocomplete="off">
    </td>
    @if(!$this->user->hasAnyRole('cliente'))
        <td>{{ form_read($item->price) }}</td>
        <td>{{ form_read($item->total) }}</td>
    @endif
    <td>
        @if($this->currents)
            @isset($this->currents[$item->id])
                <button wire:click="update({{$item}})" class="btn btn-outline-secondary update-item"><i
                        class="fa fa-sync-alt"></i> Atualizar
                </button>
            @endisset
        @endif
        @if($current_item == $item->id)
            <button wire:click="kill('{{ $item->id }}')" class="btn btn-outline-danger delete-item"><i
                    class="fa fa-trash"></i> Confirmar
            </button>
        @else
            <button wire:click="confirm('{{ $item->id }}')" class="btn btn-outline-primary delete-item"><i
                    class="fa fa-trash"></i></button>
        @endif
    </td>
</tr>


