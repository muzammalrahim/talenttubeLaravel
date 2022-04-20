
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop

@section('custom_css')
    {{-- <link rel="stylesheet" href="{{ asset('css/site/register.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/> --}}
  <link rel="stylesheet" href="{{ asset('assests/custom-css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('assests/custom-css/common.css') }}"> 

@stop

@section('classes_body', 'register user')

@section('body')

<div class="container-fluid Content emp-step-1" id="step-1">
            <a href="{{ route('homepage') }}" class="row logo">
                <img src="assests/images/talent-tube.png" alt="">
          </a>
        <div class="row cross-refrance-wrapper">
             <form name="frm_date" method="post" action="{{route('registerEmployer')}}" autocomplete="off" >
          {{ csrf_field() }}
                <div class="row update-info">
                 <h4>Almost There! Just a Little More To Go</h4>
                    <div class="col-md-6">
                       <label for="">Company Name</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><img src="assests/images/company-icon.png" alt=""></span>
                        <input type="text" name="companyname"  class="form-control" maxlength="20" value="" placeholder="This will be public" aria-label="Username" aria-describedby="basic-addon1" required>
                            <div id="companyname_check" class="icon_check to_hide"></div>
                            <div id="companyname_error" class="error to_hide">&nbsp;</div>
                      </div>
                    </div>
                    <div class="col-md-6 Search-portion">
                       <label for="">I am from</label>
                     <div class="input-group mb-3">
                        <span class="input-group-text" ><i class="fas fa-user-circle"></i></span>
                        <input type="text" class="form-control"  aria-label="Username" id="location_search" value="" placeholder="Type a location" aria-invalid="false" >
                        <button class="input-group-text Search-btn location_search_btn w20 fl_left" type="button"  id="button-addon2 location_search_load"><i class="fas fa-search"></i> Search</button>
                        <div class="location_latlong dtable w100">
                                <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                                <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">

                                <input type="hidden" name="location_name" id="location_name"  value="">
                                <input type="hidden" name="location_city" id="location_city"  value="">
                                <input type="hidden" name="location_state" id="location_state"  value="">
                                <input type="hidden" name="location_country" id="location_country"  value="">
                            </div>

                            <div class="location_map_box dtable w100" style="display: none">
                                <div class="location_map" id="location_map"></div>
                            </div>
                            <span id="location_city_error" class="error to_hide d-none">Location City Field is Required</span>
                        <span id="location_state_error" class="error to_hide d-none">Location State Field is Required</span>
                        <span id="location_country_error" class="error to_hide d-none">Location Country Field is Required</span>
                    </div>

                 </div>
                    <div class="col-md-6">
                         <label for="">Email</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-mail-bulk"></i></span>
                        <input type="text" aria-label="Username" aria-describedby="basic-addon1" id="email" name="email" class="inp email form-control" placeholder="e.g. example@site.com" value="" required>
                         <div id="email_check" class="icon_check to_hide"></div>
                            <div id="email_error" class="error to_hide">&nbsp;</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                          <label for="">Phone Number</label>
                         <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                                <input type="text"   aria-label="Username" aria-describedby="basic-addon1"
                                 id="phone"  name="phone" class="inp email placeholder form-control " placeholder="Enter Phone Number" value="" maxlength="10" minlength="10">
                             <div id="phone_check" class="icon_check to_hide"></div>
                             <div id="phone_error" class="error to_hide">&nbsp;</div>
                    </div>
                 </div>
                    <div class="col-md-6">
                         <label for="">Current Password</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                        <input type="password"   aria-label="Username" aria-describedby="basic-addon1" id="password" class="inp psw placeholder form-control" name="password"  placeholder="Password" value="" required>
                         <div id="password_check" class="icon_check to_hide"></div>
                            <div id="password_error" class="error to_hide">&nbsp;</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                             <label for="">New Password</label>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                            <input type="password"   aria-label="Username" aria-describedby="basic-addon1" id="password_confirmation" class="inp psw pswc placeholder form-control" name="password_confirmation"  placeholder="Confirm Password" value="" required>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                         <div class="form-check custom-checkbox">
                              <input class="form-check-input" type="checkbox"  id="flexCheckIndeterminate  agree"  name="privacy_policy" value="1">
                             <label class="form-check-label" for="flexCheckIndeterminate"> I agree to the <a href="{{ route('privacy') }}" target="_blank">Terms , Conditions & Privacy Policy</a>
                              </label>
                         </div>
                    </div>
                    <div class="row update-info-buttons">
                         <div class="col-sm-12 update-buttons-2" clearfix>
                             <ul class="buttons-group mb-3"> 
                                  {{-- <li class="btn-first"> <a href="" ><i class="fas fa-th-large"></i> Dashboard</a></li> --}}
                                 <li ><button class="btn btn-dark"  type="reset"><i class="fas fa-sync-alt"></i> Refresh</button></li>
                                 <li ><buttton  id="frm_emp_register_submit"  class="btn btn-success"><i class="fas fa-arrow-right"></i> Next</button></li>
                                    <span id="agree_error" class="error to_hide d-none">You need to agree to the terms</span>
                             </ul>
                         </div>
                    </div>
                </div>
                <input type="hidden" name="user_type" value="employer" />
      </form>
        </div>
        </div>

{{--  --}}
@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>

{{-- <script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/site/join.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>

<script src="{{ asset('js/site/common.js') }}"></script>
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
