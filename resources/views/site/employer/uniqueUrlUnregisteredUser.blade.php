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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    {{-- <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script> --}}

    @yield('meta_tags')
    @yield('custom_css')

</head>
<body class="{{$classes_body}}">

{{-- @yield('body') --}}

{{-- <div class="main"> --}}
 {{-- <div class="wrapper"> --}}
     {{-- @include('site.layout.userheader') --}}

    {{-- <div class="content"> --}}
    {{-- <div class="cont_w"> --}}
        <div class="columnCenters">
        <div class="col_center">
            @yield('content')
        </div>
        {{-- @include('site.layout.leftmenu') --}}
        </div>
    {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}


<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
{{-- <script src="jquery-3.5.1.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@yield('custom_footer_css')

<style type="text/css">    

    .col_center { width: 70%; background: #e9ecef; margin: 0 auto;border-radius: 10px; }
    .columnCenters {padding-top: 4%;}
    body{overflow: auto; background-image: url(http://creativedev22.xyz/images/homepage_bg.jpg) !important}
    .notbrak{display: inline-block;}
    .btn-sm {font-size: 14px !important;padding: .375rem .75rem !important;}
    label {font-weight: 700;}
</style>
@yield('custom_js')

</body>
</html>
