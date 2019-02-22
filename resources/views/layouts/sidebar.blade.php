<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        @php
            $menuItems = [];
        @endphp

        <ul class="navigation-left">
            @foreach ($menu as $key => $me)
                @if (count($me->children) > 0)
                    @php
                        $menuItems[$key] = $me->children;
                    @endphp
                @endif
                <li class="nav-item {{ request()->is('dashboard/*') ? 'active' : '' }}" data-item="{{str_slug($me->name)}}">
                    <a class="nav-item-hold" href="{{ route($me->resource) }}">
                        <i class="nav-icon {{$me->icon}}"></i>
                        <span class="nav-text">{{$me->name}}</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        
      {{--   @foreach ($menuItems as $key => $menuItem)
            <ul class="childNav" data-parent="{{str_slug($menuItem[$key]->module->name)}}">
                @foreach ($menuItem as $item)

                    <li class="nav-item">
                       
                        <a class="{{ Route::currentRouteName()=='dashboard_version_1' ? 'open' : '' }}" title="{{$item->description}}" alt="{{$item->name}}" href="">
                            <i class="nav-icon i-Clock-3"></i>
                            <span class="item-name">{{$item->name}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach --}}
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
