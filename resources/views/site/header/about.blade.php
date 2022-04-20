

{{-- @extends('adminlte::master') --}}
@extends('site.master')

{{-- @section('title', $title) --}}

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('custom_css')
  <link rel="stylesheet" href="{{ asset('assests/custom-css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('assests/custom-css/homestyle.css') }}">
@stop
@section('classes_body', 'homepage')

@section('body')





@include('site.header.header') {{-- site/header/header --}}
 
<!-- ================== banner-section start -->
<section class="container-fluid banner-section">

    <div class="row banner-main-section ">
      {{-- <div class="col-lg-7 col-md-7 col-sm-12 order-md-2 order-sm-1 banner-icon-div"> 
        <img class="banner-icon" src="assests/images/Frame.png" alt="img" />
      </div>
      <div class="col-lg-5 col-sm-12 col-md-5 headings order-md-1 order-sm-2">
       
      </div> --}}
    </div>
  {{-- <div class="container"><h1>About</h1></div> --}}

</section>


<!-- ===========================banner-section-end================== -->




<!-- ========================Job wrapper's HTML ends Here======================= -->

  
<!--==================== Body Section Completes Here=========================== -->
<!-- =====================Footer Starts here====================================== -->
<footer><div class="container-fluid bg-light">
    <div class="container">
      <div class="row  d-flex justify-content-center align-items-center">
        <div class="col-md-10 ">
         <div class="footer-nav ">
           <a href=""  class="d-block d-sm-none footer-logo-2"><img src="assests/images/frame1.png" alt=""></a>
           <ul class=" ">
             <li class=""><a href="{{ route('homepage') }}">Home</a></li>
             <li ><a href="{{ route('about-us') }}" >About</a></li>
             <li class="d-none d-sm-block" ><a href="{{ route('homepage') }}" ><img src="assests/images/frame1.png"  alt=""></a></li>
             <li ><a href="{{ route('contact-us') }}" >Contact</a></li>
             <li ><a href="{{ route('blogs') }}" >Blog</a></li>
           </ul>
         </div>
        </div>
        <div class="col-md-10 footer-icon ">
          <ul>
            {{-- <li><a href="#"  ><i class="fab fa-instagram" ></i></a></li> --}}
            {{-- <li> <a href="#" ><i class="fab fa-twitter" ></i></a> </li> --}}
            <li><a href="#" ><i class="fab fa-youtube" ></i></a> </li>
            <li><a href="#" ><i class="fab fa-facebook"></i></a></li>
            <li><a href="#" ><i class="fab fa-linkedin"></i></a></li>
             {{-- <li> <a href="#" ><i class="fab fa-pinterest"></i></a></li> --}}
          </ul>
      </div>
      <div class="col-md-12 CopyRight"><p>CopyRight 2021</p></div>
      </div>
    </div>
  </div>
</footer>  

{{-- <div class="main  "> --}}
   <!-- wrapper -->


<div class="wrappeasasar">

   {{-- @include('site.header') --}}
   {{-- @include('site.header.header') --}}


   {{-- 03-09-2021 --}}


</div>

   <!-- /wrapper -->


{{-- @include('site.home.login') --}}

{{-- @include('site.home.interviewLogin') --}}

{{-- @include('site.footer') --}}



{{-- </div> --}}

@include('web.home.interviewConcierge.signin')


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

@section('custom_footer_css')

<style type="text/css">
  
</style>

@stop


