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
        <i class="sidebar-close i-Close" (click)="toggelSidebar()"></i>
        <header>
            <div class="logo">
                <img src="{{asset('images/logo.png')}}" alt="">
            </div>
        </header>

        <!-- Submenu Dashboards -->
        @foreach ($menuItems  as $key => $menuItem)
            <div class="submenu-area" data-parent="{{str_slug($menuItem[$key]->parent->name)}}">
                <header>
                        <h6>{{$menuItem[$key]->parent->name}}</h6>
                        <p>{{$menuItem[$key]->parent->description}}</p>
                </header>
                <ul class="childNav" data-parent="{{str_slug($menuItem[$key]->parent->name)}}">
                    @foreach ($menuItem as $item)
                        <li class="nav-item">
                            <a class="{{ Route::is($item->resource) ? 'open' : '' }}"  href="@if($item->resource){{ route($item->resource) }}@else#@endif">
                                <i class="nav-icon {{$item->fav_icon}}"></i>
                                <span class="item-name">{{$item->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        <div class="sidebar-overlay"></div>
    </div>
</div>
<!--=============== Left side End ================-->
