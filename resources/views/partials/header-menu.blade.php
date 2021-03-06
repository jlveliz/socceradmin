<div class="main-header">
    <div class="logo">
        <img src="{{asset('assets/images/logo-ball.png')}}" alt="">
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div  class="user col align-self-end">
                {{-- <img src="{{asset('assets/images/faces/1.jpg')}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                <i class="i-Business-ManWoman clickable header-icon " id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{ Auth::user()->person->name . ' '.Auth::user()->person->last_name}}
                    </div>
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit()">Salir</a>
                    <form action="{{route('logout')}}" id="logout" method='post'>{{ csrf_field() }}</form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header top menu end -->
