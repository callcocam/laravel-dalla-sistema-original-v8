<div class="sidebar-panel bg-white">
    <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img
            class="pl-3" src="{{ asset($tenant->cover) }}" alt="alt"/>
        <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
        <div class="sidebar-compact-switch ml-auto"><span></span></div>
    </div>
    <!--  user -->
    <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar"
         data-suppress-scroll-x="true">
        <div class="side-nav">
            <div class="main-menu">
                <ul class="metismenu" id="menu">
                    @foreach(\App\Helpers\MenuHelper::make()->getMenus() as $menu)
                        @canany($menu['permissions'])
                            @if(!$menu['submenu'])
                                <li class="Ul_li--hover"><a href="{{ route($menu['route']) }}"><i
                                            class="{{ $menu['icon'] }} text-20 mr-2 text-muted"></i><span
                                            class="item-name text-15 text-muted">{{ __($menu['label']) }}</span></a>
                                </li>
                            @else
                                <li class="Ul_li--hover @if(request()->routeIs($menu['permissions'])) mm-active @endif">
                                    <a class="has-arrow" href="#">
                                        <i class="{{ $menu['icon'] }} text-20 mr-2 text-muted"></i>
                                        <span class="item-name text-15 text-muted">{{ __($menu['label']) }}</span>
                                    </a>
                                    <ul class="mm-collapse  @if(request()->routeIs($menu['permissions'])) mm-show @endif">
                                        @foreach($menu['submenu'] as $submenu)
                                            @if (Route::has($submenu['route']))
                                                @can($submenu['route'])
                                                    <li class="nav-item"><a
                                                            @isset($submenu['title']) title="{{$submenu['title']}}"
                                                            @endisset
                                                            href="{{ route($submenu['route']) }}"><i
                                                                class="nav-icon i-Arrow-Forward-2"></i><span
                                                                class="item-name">{{ __($submenu['label']) }}</span></a>
                                                    </li>
                                                @endcan
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endcan
                    @endforeach
                    <li class="Ul_li--hover"><a href="{{ route('admin.auth.profile.form') }}"><i
                                class="i-Administrator text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">{{ __('Minha Conta') }}</span></a>
                    </li>
                    <li class="Ul_li--hover"><a href="#" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"><i
                                class="i-Arrow-Inside text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">{{ __("Sair") }}</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
        </div>
    </div>
    <!--  side-nav-close -->
</div>
