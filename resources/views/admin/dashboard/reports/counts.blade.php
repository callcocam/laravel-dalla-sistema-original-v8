@if(auth()->user()->hasAnyRole('cliente'))
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-30 text-center"><!----><!---->
                <div class="card-body"><!----><!----><i class="i-Checkout-Basket"></i>
                    <div class="content"><p class="text-muted mt-2 mb-0">Pedidos</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $tenant->counts('orders') }}</p></div>
                </div><!----><!----></div>
        </div>
    </div>

@else
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-30 text-center"><!----><!---->
                <div class="card-body"><!----><!----><i class="i-Bar-Code"></i>
                    <div class="content"><p class="text-muted mt-2 mb-0">Produtos</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $tenant->counts('products') }}</p></div>
                </div><!----><!----></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-30 text-center"><!----><!---->
                <div class="card-body"><!----><!----><i class="i-Checked-User"></i>
                    <div class="content"><p class="text-muted mt-2 mb-0">Clientes</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $tenant->counts('users') }}</p></div>
                </div><!----><!----></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-30 text-center"><!----><!---->
                <div class="card-body"><!----><!----><i class="i-Checkout-Basket"></i>
                    <div class="content"><p class="text-muted mt-2 mb-0">Pedidos</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $tenant->counts('orders') }}</p></div>
                </div><!----><!----></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-30 text-center"><!----><!---->
                <div class="card-body"><!----><!----><i class="i-Check"></i>
                    <div class="content"><p class="text-muted mt-2 mb-0">Eventos</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $tenant->counts('events') }}</p></div>
                </div><!----><!----></div>
        </div>
    </div>
@endif
