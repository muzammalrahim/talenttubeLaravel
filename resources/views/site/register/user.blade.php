@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('custom_css')
  <link rel="stylesheet" href="{{ asset('assests/custom-css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('assests/custom-css/common.css') }}"> 
@endsection

@section('classes_body', 'homepage')

@section('body')
    <div class="container-fluid Content hide1" id="step-1">
      <a href="{{ route('homepage') }}" class="row logo">
        <img src="assests/images/talent-tube.png" alt="">
      </a>

      <div class="row cross-refrance-wrapper">
        <form name="frm_date" method="post" action="{{route('register')}}" autocomplete="on" >
          {{ csrf_field() }}

          <div class="row update-info">
            <h4>Almost There! Just a Little More To Go</h4>
            <div class="col-md-6">
              <label for="">First Name</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
                <input type="text" class="form-control" name="firstname" placeholder="First Name" required aria-label="Username" aria-describedby="basic-addon1">
              </div>

              <div id="birth_error" class="error to_hide">&nbsp;</div>

            </div>

            <div class="col-md-6">
              <label for="">Last Name</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle"></i></span>
                <input type="text" class="form-control" name="surname" placeholder="Last Name" aria-label="Username" aria-describedby="basic-addon1">
              </div>
            </div>

            <div class="col-md-6">
              <label for="">Title</label>
              <div class="input-group mb-3 seeker-title">
                <div class="form-check form-check-inline ">
                  <input class="form-check-input" value="Mr" type="radio" name="title" id="inlineRadio1" checked>
                  <label class="form-check-label" for="inlineRadio1">Mr</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" value="Ms" type="radio" name="title" id="inlineRadio2">
                  <label class="form-check-label" for="inlineRadio2">Ms</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" value="Miss" type="radio" name="title" id="inlineRadio3">
                  <label class="form-check-label" for="inlineRadio3">Miss</label>
                </div>

                <div class="form-check form-check-inline ">
                  <input class="form-check-input" value="Mrs" type="radio" name="title" id="inlineRadio4">
                  <label class="form-check-label" for="inlineRadio4">Mrs</label>
                </div>
              </div>
              {{-- <input type="hidden" name="title" class="user_title" value="Mr"> --}}

            </div>

            <div class="col-md-6 Search-portion">
              <label for="">I am from</label>
              <div class="input-group mb-3">
                <span class="input-group-text" ><i class="fas fa-user-circle"></i></span>
                <input type="text" name="location_search" class="form-control inp w80 fl_left" id="location_search" value="" placeholder="Type a location" aria-invalid="false">
                <button  id="location_search_load" class="input-group-text Search-btn btn btn-success location_search_btn w20 fl_left" ><i class="fas fa-search"></i> Search</button>
              </div>

              <div class="location_latlong dtable w100 hide_it">
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
              <span id="location_city_error" class="error to_hide">Location City Field is Required</span>
              <span id="location_state_error" class="error to_hide">Location State Field is Required</span>
              <span id="location_country_error" class="error to_hide">Location Country Field is Required</span>

            
            </div>

            <div class="col-md-6">
              <label for="">Email</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-mail-bulk"></i></span>
                <input type="email" id="email" name="email" class="form-control" placeholder="e.g. example@site.com" value="" aria-label="Username" aria-describedby="basic-addon1">
              </div>

              <div id="email_check" class="icon_check to_hide"></div>

              <div id="email_error" class="error to_hide text-danger">&nbsp;</div>

            </div>
            
            <div class="col-md-6">
              <label for="">Phone Number</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Your Phone Number" value="" maxlength="10" minlength="10" aria-label="Username" aria-describedby="basic-addon1"/>

              </div>
                <div id="phone_check" class="icon_check to_hide"></div>
                <div id="phone_error" class="error to_hide text-danger">&nbsp;</div>
            </div>

            <div class="col-md-12 Search-portion">
              <label for="">Username</label>
              <div class="input-group mb-3">
                <span class="input-group-text" ><i class="fas fa-user-circle"></i></span>
                <input type="text" id="name" class="form-control" name="username" maxlength="20" placeholder="This will be public" aria-label="Username" />
             
              </div>

                <div id="username_check" class="icon_check to_hide"></div>
                <div id="username_error" class="error to_hide text-danger">&nbsp;</div>
            </div>

            <div class="col-md-6">
              <label for=""> Password</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" aria-label="Username" aria-describedby="basic-addon1"/>

              </div>

                <div id="password_check" class="icon_check to_hide"></div>
                <div id="password_error" class="error to_hide text-danger">&nbsp;</div>
            </div>

            <div class="col-md-6">
              <div class="input-group mb-3">
                <label for="">Confirm Password</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" aria-label="Username" aria-describedby="basic-addon1" value="" required/>
 
                </div>

                  <div id="password_confirmation_check" class="icon_check to_hide"></div>
                  <div id="password_confirmation_error" class="error to_hide text-danger">&nbsp;</div>
              </div>
            </div>

            <div class="row col-md-12">
              <div class="input-group mb-3">
                <div class="custom-checkbox">
                <label class="form-check-label" for="agree">
                  <input class="form-check-input" id="agree" name="privacy_policy" value="1" type="checkbox" value="">
                  I agree to the <a href="{{ route('privacy') }}">Terms , Conditions & Privacy Policy</a>and confirm 
                  <span class="age-limit">I am at least 18 years of age or over </span>
                </label>
              </div>
            </div>

            <span id="agree_error" class="error to_hide text-danger">You need to agree to the terms</span>


          </div>

          <div class="row update-info-buttons">
            <div class="col-sm-12 update-buttons-2" clearfix>
              <ul class="buttons-group mb-3"> 

                <li class="">
                  <button class="btn btn-dark" type="reset"> <i class="fas fa-sync-alt"></i> Refresh </button>
                </li>
                
                <li  class="">
                  <button type="button" class="btn btn-success" disabled id="frm_register_submit"> <i class="fas fa-arrow-right"></i> Next </button>
                </li>
              </ul>
            </div>
          </div>

          {{-- <button id="frm_register_submit" class="btn pink disabled" disabled>Next</button> --}}

        </div>

      </form>

    </div>
  </div>

<div id="success-step-1" class="hide">

@stop


@section('custom_js')

{{-- <script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script> --}} {{-- commented on 27-09-2021 --}}
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/site/join.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>


@stop

<style type="text/css">
  .to_hide{
    opacity: 0;
  }
  .to_show{
    opacity: 1;
  }
</style>