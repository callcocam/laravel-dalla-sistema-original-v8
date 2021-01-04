@if($products->count())
        <h4>{{ __('Selecione Um Produto com valor abaixo de:') }} {{ calc_score($rows) }}</h4>
        <form action="{{ route("admin.supports-order-items.store") }}" method="post">
            @csrf
            <div class="row row-xs mb-5">
                <input name="support_order_id" value="{{ $rows->id }}" type="hidden">
                <div class="col-md-6">
                    <select name="support_id" class="form-control products" @error('support_id') is-invalid @enderror>
                        <option value="">==Selecione Um Produto==</option>
                        @foreach($products as $product)
                            <option
                                @if(calc_score_ok($rows ,$product))
                                disabled
                                @else
                                value="{{ $product->id }}"
                                @endif
                            >{{ $product->name }} - {{ $product->price }}</option>
                        @endforeach
                    </select>
                    @error('support_order_id')
                    <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <input name="amount" class="form-control" value="1" type="number" placeholder="0" min="1">
                </div>
                <div class="col-md-3 mt-3 mt-md-0">
                    <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> {{ __('Adicionar Produto') }}
                    </button>
                </div>
            </div>
        </form>
    @else
        @can("admin.supports-material.create")
            <div class="row row-xs mb-5">
                <div class="col-md-12">
                    <a href="{{ route('admin.supports-material.create') }}" class="btn btn-primary btn-block"><i
                            class="fa fa-plus"></i> {{ __('Não a material disponiveis') }}</a>
                </div>
            </div>
        @endcan
    @endif
