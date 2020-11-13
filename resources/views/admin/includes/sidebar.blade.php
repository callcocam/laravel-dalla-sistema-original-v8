<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item">
                <a class="nav-item-hold" href="{{ route('admin.admin.index') }}"><i class="nav-icon i-Dashboard"></i><span class="nav-text">{{ __('Painel') }}</span></a>
                <div class="triangle"></div>
            </li>
            @canany(['admin.products.index','admin.orders.index'])
                <li class="nav-item" data-item="orders"><a class="nav-item-hold" href="#"><i class="nav-icon i-Shopping-Cart"></i><span class="nav-text">{{ __('Pedidos') }}</span></a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @can('admin.settings.index')
                <li class="nav-item">
                    <a class="nav-item-hold" href="{{ route('admin.settings.setting') }}"><i class="nav-icon i-Gear-2"></i><span class="nav-text">{{ __('Configuração') }}</span></a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @canany(['admin.roles.index','admin.permissions.index','passport-clients','passport-authorized-clients','passport-personal-access-tokens'])
                <li class="nav-item" data-item="operacional"><a class="nav-item-hold" href="#"><i class="nav-icon i-Lock-User"></i><span class="nav-text">{{ __('Operacional') }}</span></a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @if (Route::has('admin.users.index'))
            @can('admin.users.index')
                <li class="nav-item">
                    <a class="nav-item-hold" href="{{ route('admin.users.index') }}"><i class="nav-icon i-Add-User"></i><span class="nav-text">{{ __('Usuários') }}</span></a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @endif
            @if (Route::has('admin.clients.index'))
            @can('admin.clients.index')
                <li class="nav-item">
                    <a class="nav-item-hold" href="{{ route('admin.clients.index') }}"><i class="nav-icon i-Checked-User"></i><span class="nav-text">{{ __('Clientes') }}</span></a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @endif
            @if (Route::has('admin.lendings.index'))
                @canany(['admin.lendings.index'])
                    <li class="nav-item">
                        <a class="nav-item-hold" href="{{ route('admin.lendings.index') }}"><i class="nav-icon i-Search-on-Cloud"></i><span class="nav-text">{{ __('Comodata') }}</span></a>
                        <div class="triangle"></div>
                    </li>
                @endcan
            @endif
            @canany(['admin.events-next.index','admin.events-last.index'])
                <li class="nav-item" data-item="events"><a class="nav-item-hold" href="#"><i class="nav-icon i-Calendar-2"></i><span class="nav-text">{{ __('Eventos') }}</span></a>
                    <div class="triangle"></div>
                </li>
            @endcan
            @if (Route::has('admin.visits-distributors.index'))
                @canany(['admin.visits-distributors.index'])
                    <li class="nav-item">
                        <a class="nav-item-hold" href="{{ route('admin.visits-distributors.index') }}"><i class="nav-icon i-Search-People"></i><span class="nav-text">{{ __('Visitas') }}</span></a>
                        <div class="triangle"></div>
                    </li>
                @endcan
            @endif
            @if (Route::has('admin.barrels.client.index'))
                @canany(['admin.barrels.client.index'])
                    <li class="nav-item">
                        <a class="nav-item-hold" href="{{ route('admin.barrels.client.index') }}"><i class="nav-icon i-Search-People"></i><span class="nav-text">{{ __('Meus Barrils') }}</span></a>
                        <div class="triangle"></div>
                    </li>
                @endcan
            @endif
            <li class="nav-item">
                <a class="nav-item-hold" href="{{ route('admin.auth.profile.form') }}"><i class="nav-icon i-Administrator"></i><span class="nav-text">{{ __('Minha Conta') }}</span></a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item"><a class="nav-item-hold" href="#" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"><i class="nav-icon i-Arrow-Inside"></i><span class="nav-text">{{ __("Sair") }}</span></a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>
    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
        <!-- Submenu Dashboards-->
        <ul class="childNav" data-parent="operacional">
            @if (Route::has('admin.permissions.index'))
                @can('admin.permissions.index')
                    <li class="nav-item"><a href="{{ route('admin.permissions.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Permissões') }}</span></a></li>
                @endcan
            @endif
            @if (Route::has('admin.roles.index'))
                @can('admin.roles.index')
                    <li class="nav-item"><a href="{{ route('admin.roles.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Papéis') }}</span></a></li>
                @endcan
            @endif
                @if (Route::has('passport-clients'))
                    @can('passport-clients')
                        <li class="nav-item"><a href="{{ route('passport-clients') }}" title="Passport Clients"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Passport Clients') }}</span></a></li>
                    @endcan
                @endif
                @if (Route::has('passport-authorized-clients'))
                    @can('passport-authorized-clients')
                        <li class="nav-item"><a href="{{ route('passport-authorized-clients') }}" title="Passport authorized clients"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('P. A. Clients') }}</span></a></li>
                    @endcan
                @endif
                @if (Route::has('passport-personal-access-tokens'))
                    @can('passport-personal-access-tokens')
                        <li class="nav-item"><a href="{{ route('passport-personal-access-tokens') }}" title="Personal access token"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('P. Access token') }}</span></a></li>
                    @endcan
                @endif
        </ul>
        <ul class="childNav" data-parent="orders">
            @if (Route::has('admin.products.index'))
                @can('admin.products.index')
                    <li class="nav-item"><a href="{{ route('admin.products.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Produtos') }}</span></a></li>
                @endcan
            @endif
                @if (Route::has('admin.orders.index'))
                    @can('admin.orders.index')
                        <li class="nav-item"><a href="{{ route('admin.orders.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Pedidos') }}</span></a></li>
                    @endcan
                @endif
                @if (Route::has('admin.history-barrels.index'))
                    @can('admin.history-barrels.index')
                        <li class="nav-item"><a href="{{ route('admin.history-barrels.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Histórico') }}</span></a></li>
                    @endcan
                @endif
        </ul>
        <ul class="childNav" data-parent="events">
            @if (Route::has('admin.events-last.index'))
                @can('admin.events-last.index')
                    <li class="nav-item"><a href="{{ route('admin.events-last.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Últimos Eventos') }}</span></a></li>
                @endcan
            @endif
            @if (Route::has('admin.events-next.index'))
                @can('admin.events-next.index')
                    <li class="nav-item"><a href="{{ route('admin.events-next.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Próximos Eventos') }}</span></a></li>
                @endcan
            @endif
                @if (Route::has('admin.tasks.index'))
                    @can('admin.tasks.index')
                        <li class="nav-item"><a href="{{ route('admin.tasks.index') }}"><i class="nav-icon i-Arrow-Forward-2"></i><span class="item-name">{{ __('Tarefas') }}</span></a></li>
                    @endcan
                @endif
        </ul>

    </div>
    <div class="sidebar-overlay"></div>
</div>
