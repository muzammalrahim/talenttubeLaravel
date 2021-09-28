

 




{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('custom_css')
  <link rel="stylesheet" href="{{ asset('assests/custom-css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('assests/custom-css/homestyle.css') }}">
@stop
@section('classes_body', 'homepage')

@section('body')



@include('site.header.header')
 
{{-- =================================================Loader portion starts here================================================= --}}

{{-- <div class="preloader-wrapper">
  <div class="preloader">
      <img src="assests/images/for_dribbble.gif" alt="NILA">
  </div>
</div> --}}

<!-- ================== banner-section start -->
<section class="container-fluid banner-section">

  {{-- <form action="" class=""> --}}
    <div class="row banner-main-section ">
      <div class="col-lg-7 col-md-7 col-sm-12 order-md-2 order-sm-1 banner-icon-div"> 
        <img class="banner-icon" src="assests/images/Frame.png" alt="img" />
      </div>
      <div class="col-lg-5 col-sm-12 col-md-5 headings order-md-1 order-sm-2">
       <div class="banner-info-text">
        <h1>Join The Best</h1>
        <h2>TALENT MATCHER<span >in the<strong>world.</strong></span></h2>        
        <div class=" header-buttons ">
          <div class="dual-button">
            <a href="#" class="orange_btn interview-button"><img src="assests/images/Interview-icon.svg" alt="" class="interview-icon"> <img src="assests/images/interview_hover.svg" class="interview_hover_icon" alt="" style="display: none;"> Interview concierge</a>
        {{--     <a href="dashboard.html" class="blue_btn"><i class="fas fa-th-large"></i> Dashboard</a> --}}
          </div>          
          
          <ul class="btn-infomation d-flex">
            <li><label>I am</label></li>
            
            <form id="frm_join_index_step_1" action="{{route('join')}}" method="POST">
              @csrf

              <li class="form-buttons ">
                <select id="bl_join_done_orientation" name="type" class="select_main select_index blue_btn" aria-label="">
                  <option value="user">Job Seeker</option>
                  <option value="employer">Employee</option>
                </select>
              </li>
              
              <li class="form-buttons">
                <button type="submit" class="blue_btn h-continue">Continue</button>
              </li>
            </form>

          </ul>

        </div>
       </div>
      </div>
    </div>
  {{-- </form> --}}

</section>


<!-- ===========================banner-section-end================== -->


<div class="container-fluid">
  <!-- Body text portion starts here -->    
   <h3 class="heading-first text-center">Jump Start Your Career With Us </h3>
    <p class="text-secondary text-center fist-paragrah">“The only way to do great work is to love what you do. If you haven’t found it yet, keep looking. Don’t settle.”<br>—Steve Jobs</p>
</div>

  <!-- ========================Job wrapper's HTML Starts Here======================= -->
<div class="container">
  <div class="row" >
    <div class="col-md-4 col-lg-4 col-sm-12">
       <a href="#" class="feature-wrap clearfix">
         <div class="icon-wraper">
           <img src="assests/images/icon1.png" alt="icon-1" />
         </div>
         <div class="feature-text-wrap">
           <h2>Search a Job</h2>
           <p>It’s the modern age. Your job hunt is no longer sneaker-powered. Talenttube is a right place for you.</p>
         </div>
        </a>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12">
      <a href="#" class="feature-wrap clearfix">
        <div class="icon-wraper">
          <img src="assests/images/icon2.png" alt="icon-1" />
        </div>
        <div class="feature-text-wrap">
          <h2>Apply for Job</h2>
          <p>Find your dream job by browsing jobs in major companies in world on talenttube.org.</p>
        </div>
      </a>
   </div>
    <div class="col-md-4 col-lg-4 col-sm-12">
      <a href="#" class="feature-wrap clearfix">
        <div class="icon-wraper">
          <img src="assests/images/icon3.png" alt="icon-1" />
        </div>
        <div class="feature-text-wrap">
          <h2>Get your Job</h2>
          <p>This website is one of the best websites for the job search along with simple procedures . </p>
        </div>
      </a>
   </div>
  </div>
</div>


<!-- ========================Job wrapper's HTML ends Here======================= -->

<!-- =================== main Section starts here================================-->
    
<div class="container-fluid first-section">
  <div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">  
      <div class="feature-img-wrap">
        <img src="assests/images/man.svg" alt="vector-img" />
      </div>             
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
     <div class="article">
        <h2>Tired of applying</h2>
       <h3> with Countless employers</h3>
      <p>uploading the same old documents and answering the same old question?</p>
      <p>Create a Talent Tube account today and make Employers find you!</p>
    </div>
    </div>
  </div>
</div>

<div class="container-fluid first-section">
  <div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 order-md-2 order-sm-1">  
      <div class="feature-img-wrap">
        <img src="assests/images/women.svg" alt="vector-img" />
      </div>             
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 order-md-1 order-sm-2">
     <div class="article second-article">
      <h2>Watch, compare &</h2>
      <h3> then decides to get right one</h3>
      <p>73% of all consumers are more likely to commit to a purchase after watching a video</p>
      <p> Compare that to the 84% who will reject a resume due to lack of personalisation. At Talent Tube,</p>
      <p> 
       we believe in bridging the gap between a resume and a job application through video technology, 
       to increase Job Seekers chances of success.</p>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid first-section">
  <div class="row ">
    <div class="col-sm-12 col-md-6 col-lg-6">  
      <div class="feature-img-wrap">
        <img src="assests/images/icd.svg" alt="vector-img" />
      </div>             
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
     <div class="article"> 
      <h2>Finding candidates</h2>
      <h3> with the online presence</h3>
      <p>Over 40% of Employers say they may not interview candidates if they can’t find their online presence. Create a tailored online 
        job profile that brings your experience to life, highlighting your strengths and outline the opportunities that matter to you</p>
    </div>
    </div>
  </div>
</div>

<!-- =================== main Section ends here================================-->   
<!--==================== Body Section Completes Here=========================== -->
<!-- =====================Footer Starts here====================================== -->
<footer><div class="container-fluid bg-light">
    <div class="container">
      <div class="row  d-flex justify-content-center align-items-center">
        <div class="col-md-10 ">
         <div class="footer-nav ">
           <a href=""  class="d-block d-sm-none footer-logo-2"><img src="assests/images/frame1.png" alt=""></a>
           <ul class=" ">
             <li class=""><a href="">Home</a></li>
             <li ><a href="" >About</a></li>
             <li class="d-none d-sm-block" ><a href="" ><img src="assests/images/frame1.png"  alt=""></a></li>
             <li ><a href="" >Contact</a></li>
             <li ><a href="" >Blog</a></li>
           </ul>
         </div>
        </div>
        <div class="col-md-10 footer-icon ">
          <ul>
            <li><a href="#"  ><i class="fab fa-instagram" ></i></a></li>
            <li> <a href="#" ><i class="fab fa-twitter" ></i></a> </li>
            <li><a href="#" ><i class="fab fa-youtube" ></i></a> </li>
            <li><a href="#" ><i class="fab fa-facebook"></i></a></li>
             <li> <a href="#" ><i class="fab fa-pinterest"></i></a></li>
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


@include('site.home.login')

@include('site.home.interviewLogin')

@include('site.footer')



{{-- </div> --}}
<!-- /main -->


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

{{-- 
  <script>
  jQuery(document).ready(function($) {
    var Body = $('body');
    Body.addClass('preloader-site');
});
$(window).load(function(){
  $('.preloader-wrapper').fadeOut();
    $('body').removeClass('preloader-site');
});
</script> --}}
@stop
