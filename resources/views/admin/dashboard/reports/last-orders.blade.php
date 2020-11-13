<div class="row">
    <div class="col">
        <div class="card mb-30">
            <div class="card-body">
                @if($tenant->orders('not-accepted')->count())
                    <div class="card-title">Ùltimos pedidos - Pedidos Aguardando Aprovação</div>
                    @foreach($tenant->orders('not-accepted') as $last)
                        @include('admin.dashboard.reports.items',compact('last'))
                    @endforeach
                @endif
                @if($tenant->orders()->count())
                    <div class="card-title">Últimos pedidos - Pedidos Aberto</div>
                    @foreach($tenant->orders() as $last)
                        @include('admin.dashboard.reports.items',compact('last'))
                    @endforeach
                @endif
                @if($tenant->orders('transit')->count())
                    <div class="card-title">Últimos pedidos - Em Trânsito</div>

                    @foreach($tenant->orders('transit') as $last)
                        @include('admin.dashboard.reports.items',compact('last'))
                    @endforeach
                @endif
                @if($tenant->orders('completed')->count())
                    <div class="card-title">Últimos pedidos - Completos</div>

                    @foreach($tenant->orders('completed') as $last)
                        @include('admin.dashboard.reports.items',compact('last'))
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
