<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{config('app.name')}}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    @yield('before-css')
    {{-- theme css --}}
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets/fonts/iconsmind/iconsmind.css')}}">

    @yield('css')
    
    {{-- colors --}}
    @php 
      $color = session('color');  
    @endphp  
    
    @if ($color=="blue")
      <link id="gull-theme" rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-blue.min.css')}}">
    @elseif(!$color || $color=="purple")
      <link id="gull-theme" rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
    @endif
    
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/perfect-scrollbar.css')}}">
     {{-- page specific css --}}
     @yield('page-css')
</head>

<body class="text-left">
    @php 
      $layout = session('layout');  
    @endphp

  <!-- ============ Compact Layout start ============= -->
    @if ($layout=="compact")
        {{-- compact layout --}}
        <div class="app-admin-wrap layout-sidebar-compact sidebar-dark-purple sidenav-open clearfix">
            @include('partials.sidebar-compact')
            {{-- end of left sidebar --}}
            <!-- ============ Body content start ============= -->
            <div class="main-content-wrap d-flex flex-column">
                @include('partials.header-menu')
                {{-- end of header menu --}}
                <div class="main-content">

                  @include('partials.breadcrump')

                  @yield('content')
                </div>

                @include('partials.footer')
            </div>
        <!-- ============ Body content End ============= -->
        </div>
        <!--=============== End app-admin-wrap ================-->

          <!-- ============ Search UI Start ============= -->
        {{-- @include('partials.search') --}}
          <!-- ============ Search UI End ============= -->

        @include('partials.compact-sidebar-customizer')
       <!-- ============ Compact Layout End ============= -->



<!-- ============ Horizontal Layout start ============= -->

    @elseif($layout=="horizontal")
        {{-- normal layout --}}
        <div class="app-admin-wrap layout-horizontal-bar clearfix">
            @include('partials.header-menu')
            {{-- end of header menu --}}

            {{-- end of left sidebar --}}
            @include('partials.horizontal-bar')
            <!-- ============ Body content start ============= -->
            <div class="main-content-wrap  d-flex flex-column">
              <div class="main-content">
                  
                  @include('partials.breadcrump')
                  
                  @yield('content')
              </div>
            
              @include('partials.footer')
            </div>

            <!-- ============ Body content End ============= -->
        </div>
        <!--=============== End app-admin-wrap ================-->
        <!-- ============ Search UI Start ============= -->
        {{-- @include('partials.search') --}}
        <!-- ============ Search UI End ============= -->
        @include('partials.horizontal-customizer')

        <!-- ============ Horizontal Layout End ============= -->


    <!-- ============ Large SIdebar Layout start ============= -->
    @elseif($layout=="normal")
        {{-- normal layout --}}
        <div class="app-admin-wrap layout-sidebar-large clearfix">
            @include('partials.header-menu')
            {{-- end of header menu --}}
            @include('partials.sidebar')
            {{-- end of left sidebar --}}

            <!-- ============ Body content start ============= -->
            <div class="main-content-wrap sidenav-open d-flex flex-column">
              <div class="main-content">
                  
                  @include('partials.breadcrump')

                  @yield('content')
              </div>

              @include('partials.footer')
            </div>
            <!-- ============ Body content End ============= -->
        </div>
        <!--=============== End app-admin-wrap ================-->

        <!-- ============ Search UI Start ============= -->
        {{-- @include('partials.search') --}}
        <!-- ============ Search UI End ============= -->

        @include('partials.large-sidebar-customizer')


        <!-- ============ Large Sidebar Layout End ============= -->

    @else
       <!-- ============ Large SIdebar Layout start ============= -->
        
      {{-- normal layout --}}
          <div class="app-admin-wrap layout-sidebar-large clearfix">
              @include('partials.header-menu')
              {{-- end of header menu --}}

              @include('partials.sidebar')
              {{-- end of left sidebar --}}
              <!-- ============ Body content start ============= -->
              <div class="main-content-wrap sidenav-open d-flex flex-column">
                <div class="main-content">
                    @include('partials.breadcrump')
                    
                    @yield('content')
                </div>
                @include('partials.footer')
              </div>
          <!-- ============ Body content End ============= -->
          </div>
          <!--=============== End app-admin-wrap ================-->

          <!-- ============ Search UI Start ============= -->
          {{-- @include('partials.search') --}}
          <!-- ============ Search UI End ============= -->

          @include('partials.large-sidebar-customizer')

          <!-- ============ Large Sidebar Layout End ============= -->
    @endif




  {{-- common js --}}
  <script src="{{asset('assets/js/common-bundle-script.js')}}"></script>
    {{-- page specific javascript --}}
    
    {{-- theme javascript --}}
    {{-- <script src="{{mix('assets/js/es5/script.js')}}"></script> --}}
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script>
    @if ($layout=='compact')
      <script src="{{asset('assets/js/es5/sidebar.compact.script.min.js')}}"></script>
    @elseif($layout=='normal' || !$layout)
      <script src="{{asset('assets/js/es5/sidebar.large.script.min.js')}}"></script>
    @elseif($layout=='horizontal')
      <script src="{{asset('assets/js/sidebar-horizontal.script.js')}}"></script>
    @endif



    <script src="{{asset('assets/js/es5/customizer.script.min.js')}}"></script>

    <script src="{{ asset('js/custom.min.js') }}"></script>

    @yield('js')


    {{-- laravel js --}}
    {{-- <script src="{{mix('assets/js/laravel/app.js')}}"></script> --}}

    {{-- @yield('bottom-js') --}}

    {{-- modals --}}
    @include('partials.modals-delete')
    @include('partials.modals-search')
</body>

</html>
