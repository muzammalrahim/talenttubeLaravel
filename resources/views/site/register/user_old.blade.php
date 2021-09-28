{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop


@section('custom_css')

    <link rel="stylesheet" type="text/css" href="{{ asset('assests/custom-css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assests/custom-css/forms.css') }}">

@stop

@section('classes_body', 'register user')

@section('body')

{{-- <div class="main  above ">
   <div class="wrapper">
        @include('site.header2')
        <div class="wrap_header_cont absolute"  style="background-image: url({{asset('/images/homepage_bg.jpg')}});">
            <div class="bl" style="background: rgba(0, 0, 0, 0.5);">

                <div class="talenttubeLogo">
                    <div class="bl_logo">
                         <a href="{{route('homepage')}}"><img id="logo_main_page" src="{{asset('/images/talenttube.png')}}" style="height:70px;" alt="" /></a>
                    </div>
                </div>

                @include('site.register.user_step1') 

            </div>
        </div>
    </div>
</div> --}}


<div class="container-fluid Content">
    <div class="row logo">
        <img src="assests/images/talent-tube.png" alt="">
    </div>
    <div class="row  cross-refrance-wrapper">
        <div class="row update-info">
            <form name="frm_date" method="post"  action="{{route('register')}}" autocomplete="off">
              {{csrf_field() }}
            <h4>Almost There! Just a Little More To Go</h4>
              <div class="col-md-6">
                <label for="">First Name</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
                        <input type="text" class="form-control" placeholder="First Name" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
              </div>
              <div class="col-md-6">
                <label for="">Last Name</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
                        <input type="text" class="form-control" placeholder="Last Name" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
              </div>
              <div class="col-md-6">
                <label for="">Title</label>
                    <div class="input-group mb-3 seeker-title">
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">Mr</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Ms</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                            <label class="form-check-label" for="inlineRadio3">Miss</label>
                          </div>
                          <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                            <label class="form-check-label" for="inlineRadio4">Mrs</label>
                          </div>
                      </div>
              </div>
              <div class="col-md-6 Search-portion">
                <label for="">I am from</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" ><i class="fas fa-user-circle"></i></span>
                        <input type="text" class="form-control" placeholder="I am From" aria-label="Username" >
                        <button class="input-group-text Search-btn" ><i class="fas fa-search"></i> Search</button>
                  </div>
                  
              </div>
             
              <div class="col-md-6">
                <label for="">Email</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-mail-bulk"></i></span>
                        <input type="text" class="form-control" placeholder="Enter your Email" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
              </div>
              <div class="col-md-6">
                <label for="">Phone Number</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                        <input type="text" class="form-control" placeholder="Enter Your Phone Number" aria-label="Username" aria-describedby="basic-addon1">
                  </div>
              </div>
              <div class="col-md-12 Search-portion">
                <label for="">Username</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" ><i class="fas fa-user-circle"></i></span>
                        <input type="text" class="form-control" placeholder="User name" aria-label="Username" >
                        
                  </div>
                  
              </div>
              <div class="col-md-6">
                    <label for="">Current Password</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="Enter your current password" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                    <label for="">New Password</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="Enter New Password" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
                      
                  </div>
              </div>
              <div class="row col-md-12">
                <div class="input-group mb-3">
                <div class="custom-checkbox">
                  <label class="form-check-label" for="flexCheckIndeterminate">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                      I agree to the <a href="#">Terms , Conditions & Privacy Policy</a>and confirm <span class="age-limit">I am at least 18 years of age or over</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row update-info-buttons">
              <div class="col-sm-12 update-buttons-2" clearfix>
                    <ul class="buttons-group mb-3"> 
                         <li class="btn-first"> <a href="" ><i class="fas fa-th-large"></i> Dashboard</a></li>
                         <li class="btn-four"><a href="" ><i class="fas fa-sync-alt"></i> Refresh</a></li>
                         <li  class="btn-second"><a href=""><i class="fas fa-arrow-right"></i> Next</a></li>
                    </ul>
                    </div>
              </div>
            </form>
        </div>
    </div>
</div>

@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/join.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

@stop

@section('custom_footer_css')
<style>
.header, .main.above .wrapper {
    background: #5b0079;
}
.bl_logo{
    width: 20% !important;
}
</style>
@stop
