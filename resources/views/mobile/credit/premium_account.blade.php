{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')

<div class="newJobCont">
    <div class="head icon_head_browse_matches jobInfoFont text-center mb-2">Premium Account</div>

    <div class="cont cont_boost_plan" style="display: block;">

      {{-- <ul> --}}
        <p>
          Are you interested in contacting some job seekers that interest you or your organisation? If so, please contact us at 
          <a class="bold pointer" href="mailto:info@talenttube.org"> info@talenttube.org </a> to for our latest prices and packages. By accessing our premium account features, you must also agree to the following:

          </p>

      <p>
        1) You agree to only contact job seekers about relevant employment opportunities 

      </p>

      <p>
        2) You are welcome to share the more open details of our job seekers with people in your network (their video intro, snapshot, profile, etc) who may have relevant job opportunities. However, please contact the job seeker directly for their permission if you wish to share the details you can access as a Premium Account holder (resume, contact details, full name)
      </p>

      <p>
        3) You are under no circumstances allowed to share our job seeker data with marketing companies
      </p>

      <p>
        4) You understand this is not a dating site or platform to do anything other than to discuss relevant employment opportunities with job seekers. Any non-employment related approaches will be reported.
      </p>

      <p>
        Failure to comply with the above will result in the immediate cancelation of your account, and in some circumstances, our job seekers may pursue this further with the local authorities or civil courts. 
      </p>
      {{-- </ul> --}}
        


        <div class="cl"></div>
    </div>



    <div class="cl"></div>
</div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<style type="text/css">
  .container-fluid {
    font-size: 12px;
}
</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>

@stop
