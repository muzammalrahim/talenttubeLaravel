{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop


@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/site/register.css') }}">
@stop

@section('classes_body', 'register user')

@section('body')


<!-- main -->
<div class="main  above ">
   <!-- wrapper -->
   <div class="wrapper">

    @include('site.header')


    <!-- header_cont  -->
    <div class="wrap_header_cont absolute">
    <!-- header_cont_bl -->
    <div class="bl">
        <div class="bl_logo">
            <img id="logo_main_page" src="/images/site/header_impact.png" style="height:44px;" alt="" />
        </div>

        @include('site.register.user_step1')

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
@stop

@section('custom_footer_css')
<style>
.header, .main.above .wrapper {
    background: #5b0079;
}
</style>
@stop
