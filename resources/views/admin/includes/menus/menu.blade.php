@inject('resources', 'App\Services\MenuService')
@forelse($resources->getMenus() as  $menu)
    @canany($resources->getPermissions($menu))
       @switch($menu->type)
           @case('template')

           @break
           @default
           <li class="nav-item">
               <a class="nav-item-hold"
                  @if($menu->route)
                  href="{{ route(sprintf("admin.%s.%s", $menu->route, $menu->action)) }}"
                  @else
                  href="#"
                   @endif
               ><i class="nav-icon i-{{ $menu->icon }}"></i><span class="nav-text">{{ __($menu->name) }}</span></a>
               <div class="triangle"></div>
           </li>
           @endswitch
    @endcan
    @empty
@endforelse

