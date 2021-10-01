<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

       <!-- Favicons-->
    <link rel="icon" href="{{ asset('images/favi-icon.svg') }}" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favi-icon.svg') }}">
    <link rel="icon" href="{{ asset('images/favi-icon.svg') }}" sizes="32x32">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favi-icon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('images/favi-icon.svg') }}" />
  


    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>

    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    --}}
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> --}}
    {{-- @include('adminlte::plugins', ['type' => 'css']) --}}
    {{-- @yield('adminlte_css_pre') --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}"> --}}
    {{-- @yield('adminlte_css') --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    @else
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @endif

    @yield('meta_tags')

   

    <script type="text/javascript">
        var base_url = '{!! url('/') !!}';
  </script>

    @yield('custom_css')

</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')

@if(! config('adminlte.enabled_laravel_mix'))
    <script src="{{ asset('js/lang.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
{{-- @include('adminlte::plugins', ['type' => 'js']) --}}
{{-- @yield('adminlte_js') --}}
@else
<script src="{{ mix('js/app.js') }}"></script>
@endif

@yield('custom_footer_css')
@yield('custom_js')

</body>
</html>
