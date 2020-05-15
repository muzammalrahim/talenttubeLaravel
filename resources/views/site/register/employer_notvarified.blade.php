
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
    <div class="wrap_header_cont absolute h100"  style="background-image: url({{asset('/images/homepage_bg.jpg')}});">
    <!-- header_cont_bl -->
    <div class="bl" style="background: rgba(0, 0, 0, 0.5);">
        <div class="bl_logo">
            <img id="logo_main_page" src="{{asset('/images/site/header_impact.png')}}" style="height:44px;" alt="" />
        </div>

        <div id="success-step-1" class="hide to_show"><div class="slogan">Please verify your email address.</div></div>
        <div class="hide_itX  ">
            <div class="cont_w">
            <form class="bl_form_registration" name="frm_date" id="employer_verification_resend" method="post" action="{{route('resendVerificationCode')}}" autocomplete="off">
            {{ csrf_field() }}
            <div id="bl_frm_register" class="part float_none margin_auto">
                <div class="bl">
                    <label>Email Address</label>
                        <div class="col-sm-12 ">
                            <input id="resendVerificationEmail" name="email" class="inp email placeholder" type="text" placeholder="e.g. example@site.com" value=""/>
                        </div>
                    <div class="cl"></div>
                    <div id="resendVerificationEmail_error" class="error to_hide">Required</div>
                </div>

                <button id="emp_email_verification_resend"  class="btn pink" disabled>ReSend Verification email</button>
            </div>
            <input type="hidden" name="user_type" value="employer" />
            </form>
            <div class="cl"></div>
            </div>
        </div>
    </div>
    <!-- header_cont_bl -->
    </div>
    <!-- /header_cont  -->
</div>
<!-- /wrapper -->
   @include('site.home.login')
   {{-- @include('site.footer') --}}
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
@stop

@section('custom_footer_css')
<style>
.header, .main.above .wrapper {
    background: #5b0079;
}
</style>
@stop







