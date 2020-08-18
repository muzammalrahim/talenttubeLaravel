{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop


@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/site/register.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/>

@stop

@section('classes_body', 'register user')

@section('body')


<!-- main -->
<div class="main  above ">
   <!-- wrapper -->
   <div class="wrapper">

    @include('site.header2')


    <!-- header_cont  -->
    <div class="wrap_header_cont absolute"  style="background-image: url({{asset('/images/homepage_bg.jpg')}});">
    <!-- header_cont_bl -->
    <div class="bl" style="background: rgba(0, 0, 0, 0.5);">
        <div class="bl_logo">
             <a href="{{route('homepage')}}"><img id="logo_main_page" src="{{asset('/images/site/header_impact.png')}}" style="height:44px;" alt="" /></a>
        </div>

        @include('site.register.employer_step1')

    </div>
    <!-- header_cont_bl -->
    </div>
    <!-- /header_cont  -->



</div>
<!-- /wrapper -->


   @include('site.home.login')

   @include('site.footer')



</div>
<!-- /main -->


@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/join.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

<script src="{{ asset('js/site/common.js') }}"></script>
@stop

@section('custom_footer_css')
<style>
.header, .main.above .wrapper {
    background: #5b0079;
}
</style>
@stop
