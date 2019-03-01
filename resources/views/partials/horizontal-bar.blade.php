<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="menu float-left">
                    @foreach ($menu as $item)
                        <li class="{{ Route::is($item->resource) ? 'active' : '' }}">
                            <div>
                                <div>
                                    @if (count($item->children) > 0)
                                        <label class="toggle" for="drop-2">{{$item->name}}</label>
                                    @endif
                                    <a href="@if(count($item->children) > 0)#@elseif($item->resource){{ route($item->resource) }}@endif">
                                        <i class="nav-icon mr-2 {{$item->fav_icon}}"></i>
                                         {{$item->name}}
                                    </a>
                                    @if(count($item->children) > 0) 
                                        <input type="checkbox" id="drop-2">
                                        <ul>
                                            @foreach ($item->children as $child)
                                                <li class="nav-item ">
                                                    <a class="{{ Route::is($child->resource) ? 'open' : '' }}" href="@if($child->resource){{ route($child->resource) }}@else # @endif">
                                                        <i class="nav-icon mr-2 {{$child->fav_icon}}"></i>
                                                        <span class="item-name">{{$child->name}}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!--=============== Horizontal bar End ================-->
