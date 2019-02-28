<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        @php
            $menuItems = [];
        @endphp

        <ul class="navigation-left">
            @php $idx = 0; @endphp
            @foreach ($menu as $key => $me)
                @if (count($me->children) > 0)
                    @php
                        $menuItems[$idx] = $me->children;
                        $idx++;
                    @endphp
                @endif
                <li class="nav-item {{ Route::is($me->resource) ? 'active' : '' }}" @if(!$me->resource) data-item="{{str_slug($me->name)}}@endif">
                    <a class="nav-item-hold" href="@if($me->resource){{ route($me->resource) }}@else # @endif">
                        <i class="nav-icon {{$me->fav_icon}}"></i>
                        <span class="nav-text">{{$me->name}}</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        @for ($i = 0; $i < count($menuItems) ; $i++)
            <ul class="childNav" data-parent="{{str_slug($menuItems[$i][0]->parent->name)}}">
            @for ($y = 0; $y < count($menuItems[$i]) ; $y++)
                <li class="nav-item">                       
                    <a class="{{ Route::currentRouteName()=='dashboard_version_1' ? 'open' : '' }}" title="{{$menuItems[$i][$y]->description}}" alt="{{$menuItems[$i][$y]->name}}" href="@if($menuItems[$i][$y]->resource){{route($menuItems[$i][$y]->resource) }}@else#@endif">
                        <i class="nav-icon {{$menuItems[$i][$y]->fav_icon}}"></i>
                        <span class="item-name">{{$menuItems[$i][$y]->name}}</span>
                    </a>
                </li>   
            @endfor
            </ul>
        @endfor
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->
