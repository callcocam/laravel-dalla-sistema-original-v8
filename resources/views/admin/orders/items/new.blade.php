@if($this->products->count())
<h4>{{ __('Selecione Um Produto') }}</h4>
<form action="{{ route("admin.items.store") }}" method="post">
    @csrf
    <div class="row row-xs mb-5">
       <div class="col-md-6">
            <select wire:model.lazy="product_id" name="product_id" class="form-control products" @error('email') is-invalid @enderror>
                <option value="">==Selecione Um Produto==</option>
                @foreach($this->products as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <input wire:model.lazy="amount" name="amount" class="form-control" value="1" type="number" placeholder="0" min="1" autocomplete="off">
        </div>
        <div class="col-md-3 mt-3 mt-md-0">
            <button wire:click="store" type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> {{ __('Adicionar Produto') }}</button>
        </div>
    </div>
</form>
    @else
    <div class="row row-xs mb-5">
        <div class="col-md-12">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> {{ __('Não a produtos disponiveis') }}</a>
        </div>
    </div>
@endif
