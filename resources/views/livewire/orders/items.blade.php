<div>
    @include('admin.orders.items.new')
    <div class="col-md-12 table-responsive">
        <table class="table table-hover mb-3">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Nome Do Produto') }}</th>
                <th scope="col">{{ __('Qtd atual') }}</th>
                <th scope="col" width="100">{{ __('Nova qtd') }}</th>
                @if(!$this->user->hasAnyRole('cliente'))
                    <th scope="col">{{ __('Valor Unit.') }}</th>
                    <th scope="col">{{ __('Total') }}</th>
                @endif
                <th scope="col" width="250"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($this->items as $item)
                @include('admin.orders.items.list')
            @empty
                <tr>
                    <th scope="row" colspan="6">Não a items para o pedido corrente</th>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
    <div class="col-md-12">
        @include('admin.orders.total')
    </div>
</div>
@push('Lscripts')
    <script>
        Livewire.on('clear', function () {
            let message = document.getElementById('message');
            setTimeout(function () {
                // console.log(message);
            }, 5000)
        });

    </script>
@endpush
