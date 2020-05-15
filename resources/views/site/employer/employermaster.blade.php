<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/style.css') }}">

    @yield('meta_tags')
    @yield('custom_css')


    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

</head>
<body class="{{$classes_body}}">

{{-- @yield('body') --}}

<div class="main">
 <div class="wrapper">
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

@yield('custom_footer_css')
@yield('custom_js')

</body>
</html>
