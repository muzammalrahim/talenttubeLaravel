{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assests/custom-css/Style.css') }}">

    <link rel="stylesheet" href="{{ asset('assests/custom-css/MyStyle.css') }}"> 
@endsection

@section('classes_body', 'homepage')

@section('body')



<div class="container-fluid Content">
  <div class="row logo">
    <img src="{{ asset('assests/images/talent-tube.png') }}" alt="">
  </div>

  <div class="row signin-wrapper">
    <div class="signin">
       <h2 class="text-center">Sign In </h2>
       <form id="form_login" class="form_login" method="post" autocomplete="on" action="{{route('login')}}">
        {{ csrf_field() }}

        <div class="email">
        <label for="username">Your Email or Username</label>
        <div class="input-group mb-3 ">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
            <input type="email" required id="form_login_user" name="email" class="form-control" placeholder="Email or Username" aria-label="Username" aria-describedby="basic-addon1">
            <input type="hidden" name="login_type" value="site_ajax" />
            <div class="error"></div>
          </div>
        </div>
        <div class="password">
            <label for="password">Password</label>
            <div class="input-group  ">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                <input type="password" required class="form-control inp placeholder" id="form_login_pass" name="password"  placeholder="Enter Password" aria-label="Username" aria-describedby="basic-addon1">
              </div>
                <span class="errorMessageLogIn"></span>

              <a href="{{ route('forgetPassword') }}" clearfix>Forgot Password?</a>
            </div>
            <div class="mb-3 form-check custom-checkbox">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
              </div>
              <div class="submit">
                  <button type="submit" id="form_login_submit" class="orange_btn"> Sign In</button>
              </div>
              <p class="optional">Or</p>
            <div class="registration-link">  <a href="{{ route('register') }}" >Register Account?</a></div>
       </form>
    </div>
  </div>

</div>

@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>

    

{{-- <script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script> --}}

<script src="{{ asset('assests/bootstrap/js/jquery.js') }}"></script>
<script src="{{ asset('assests/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assests/bootstrap/js/bootstrap.min.js')}}"></script>

@stop
