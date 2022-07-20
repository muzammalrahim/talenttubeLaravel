{{-- @extends('adminlte::master') --}}
@extends('site.master')

{{-- @section('title', $title) --}}

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assests/custom-css/Style.css') }}">

    <link rel="stylesheet" href="{{ asset('assests/custom-css/MyStyle.css') }}"> 
@endsection

@section('classes_body', 'homepage')

@section('body')



<div class="container-fluid Content pb-5">
  <div class="row logo">
    <a href="{{ route('homepage') }}" class="text-center w-25"><img src="{{ asset('assests/images/talent-tube.png') }}" alt=""></a>
  </div>

  <div class="row signin-wrapper">
    <div class="signin py-3">
       <div class="row px-3">
         <div class="col-lg-7 col-md-6 col-sm-12 col-12 order-2 order-sm-2 order-2 order-md-1 wow">
           <h3 class="pb-2">About Us</h3>
           <p>
             Talent Tube is an all in 1 recruitment solution for connecting great tech talent with employers who are looking for those hidden gems in the job market. Often times we overlook talent due to a bland, ill structured resume, that makes it impossible to showcase the candidate’s soft skills, which when incorrectly assessed, can be attributed to up to <span><a href="#">89% of poor hires</a></span>.   
           </p>
           <p>
             At Talent Tube, we don’t pretend to have ‘better’ talent in our database, but offer an opportunity to partner with Employers, and showcase our candidates attributes in a 360 degree view, which includes video introductions, psychometric testing, AI match making algorithms in addition to traditional methods such as CVs and Cover Letters.
           </p>
           <p>
             Speak to one our consultants today, to conduct a short role briefing, and let us help source and showcase suitable candidates for your technical talent needs. Currently we are specialising in developers, UX/UI designers, testers, IT project managers, Dev Ops and more, but also happy to discuss other recruitment needs in the Australian market. 
           </p>
         </div>
         <div class="col-lg-5 col-md-6 col-sm-12 col-12 order-1 order-sm-1 order-md-2 wow">
           <img src="assests/images/Frame.png" class="img-fluid" alt="img">
         </div>
       </div>
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

<style type="text/css">
  .Content .signin{
    width: 97% !important;
  }
  .Content .logo{
    padding: 30px 0px !important;
  }
  .wow h3{
    font-weight: 500;
    font-size: 24px;
  }
  .wow p{
    font-weight: 500;
    font-size: 18px;
  }
  .wow img{
    width: 100%;
    height: auto;
  }
</style>