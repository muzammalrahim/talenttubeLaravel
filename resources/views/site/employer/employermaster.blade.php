<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    {{-- <link rel="icon" href="https://talenttube.tv/wp-content/themes/talenttube/favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" href="http://creativedev22.xyz/images/site/logo_inner.png">
    <link rel="icon" href="https://talenttube.org/images/site/logo_inner.png" sizes="32x32">
    <link rel="icon" type="image/png" sizes="16x16" href="https://talenttube.org/images/site/logo_inner.png">
    <link rel="shortcut icon" href="https://talenttube.org/images/site/logo_inner.png" /> --}}

    <!-- Favicons-->
    <link rel="icon" href="{{ asset('images/favi-icon.svg') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favi-icon.svg') }}">
    <link rel="icon" href="{{ asset('images/favi-icon.svg') }}" sizes="32x32">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favi-icon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('images/favi-icon.svg') }}" />
  
  
    <title>@yield('title')</title>


    

    {{-- <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/common.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/site/style.css') }}"> --}}


    {{-- New Style --}}

    <link rel="stylesheet" href="{{ asset('assests/bootstrap/css/bootstrap.css') }}" >
    <link rel="stylesheet" href="{{ asset('assests/bootstrap/css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- =========== custome-file css =================================== -->
    <link rel="stylesheet" href="{{ asset('assests/custom-css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assests/custom-css/dashboard.css') }}">

    



    @yield('meta_tags')
    @yield('custom_css')


    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    {{-- Including Bootstrap --}}
    <script src="{{ asset('assests/bootstrap/js/jquery.js') }}"></script>
    <script src="{{ asset('assests/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assests/bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assests/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assests/custom-js/custom.js') }}"></script>
    

</head>
<body class="{{$classes_body}}">

{{-- @yield('body') --}}

{{-- <div class="main">
 <div class="wrapper">

    @if ($controlsession->count() > 0)
    <div class="adminControl">
        <p>You are in control of <span class="bold">{{$user->company}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
    </div>
    @endif
    
    @include('site.layout.userheader')

    <div class="content">
    <div class="cont_w">
        <div class="column_main">
        <div class="col_center">
            @yield('content')
        </div>
        @include('site.layout.leftmenu')
        </div>
    </div>
    </div>
</div>
</div> --}}


<div class="main-body">

    <div class="container-fluid">

        @if ($controlsession->count() < 0)
        <div class="adminControl">
            <p>You are in control of <span class="bold">{{$user->company}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
        </div>
        @endif

        <div class="row sidebar-row">
        
            @include('site.layout.site_leftSideBar') {{-- site/layout/site_leftSideBar --}} 

            <div class="main-content col-lg-10 col-md-12 col-sm-12">
                @include('site.layout.leftSideBar') {{-- site/layout/leftSideBar --}} 
                @yield('content') 
            </div>

        </div>

    </div>

</div>


 {{-- @include('site.user.footer') --}}

<script src="{{asset('/js/lang.js')}}"></script>

<script src="{{ asset('js/site/modernizr.js') }}"></script>
<script src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script src="{{ asset('js/site/impact_lib.js') }}"></script>
<script src="{{ asset('js/site/lib.js') }}"></script>
<script src="{{ asset('js/site/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script>


{{-- <script src="{{ asset('js/site/profile.js') }}"></script>  --}}

<script src="{{ asset('js/site/userProfile.js') }}"></script>


<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
{{-- <script type="text/javascript" src="{{ asset('js/site/location_gmap.js') }}"></script> --}}

@yield('custom_footer_css')
@yield('custom_js')

</body>
</html>
