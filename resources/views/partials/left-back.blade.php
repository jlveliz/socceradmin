 <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                       {{--  @foreach ($menu as $module)
                            <li class="nav-label">{{ $module->name }}</li>
                            @foreach ($module->permissions as $permission)
                                <li> <a href="@if(Route::has($permission->resource)){{ route($permission->resource) }}@else#{{ str_slug($permission->name) }}@endif" class="@if(count($permission->children) > 0)has-arrow @endif" @if(count($permission->children) > 0) data-toggle="collapse" aria-expanded="false"@endif><i class="fa {{ $permission->fav_icon }}"></i> <span class="hide-menu">{{ $permission->name }}</span></a>
                                    @if (count($permission->children) > 0)
                                        <ul aria-expanded="false" class="collapse" id="{{ str_slug($permission->name) }}">
                                            @foreach ($permission->children as $subEl)
                                                <li><a href="{{ route($subEl->resource) }}">{{ $subEl->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endforeach --}}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>