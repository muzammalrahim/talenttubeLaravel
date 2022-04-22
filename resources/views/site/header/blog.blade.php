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
       <div class="row px-3 pb-0 pb-md-3">
            <h3 class="pb-2">Blog</h3>
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="wow pb-2 mb-sm-4">
                   <img src="assests/images/jobs.png" alt="img">
                   <h6 class="px-2">
                       Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   </h6>
                   <p class="px-2">
                       Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                   </p>
                   <div class="px-2">
                       <a href="#"><i class="fab fa-facebook pr-2 icon fa-2x"></i></a>
                       <a href="#"><i class="fab fa-youtube icon pr-2 fa-2x"></i></a>
                       <a href="#"><i class="fab fa-twitter icon fa-2x"></i></a>
                       <span class="float-right">
                           <a href="{{ route('blog.detail') }}">Read More <span><i class="fas fa-arrow-right pt-1"></i></span></a>
                       </span>
                   </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="wow pb-2 mb-sm-4">
                   <img src="assests/images/jobs.png" alt="img">
                   <h6 class="px-2">
                       Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   </h6>
                   <p class="px-2">
                       Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                   </p>
                   <div class="px-2">
                       <a href="#"><i class="fab fa-facebook pr-2 icon fa-2x"></i></a>
                       <a href="#"><i class="fab fa-youtube icon pr-2 fa-2x"></i></a>
                       <a href="#"><i class="fab fa-twitter icon fa-2x"></i></a>
                       <span class="float-right">
                           <a href="{{ route('blog.detail') }}">Read More <span><i class="fas fa-arrow-right pt-1"></i></span></a>
                       </span>
                   </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="wow pb-2 mb-sm-4">
                   <img src="assests/images/jobs.png" alt="img">
                   <h6 class="px-2">
                       Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   </h6>
                   <p class="px-2">
                       Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                   </p>
                   <div class="px-2">
                       <a href="#"><i class="fab fa-facebook pr-2 icon fa-2x"></i></a>
                       <a href="#"><i class="fab fa-youtube icon pr-2 fa-2x"></i></a>
                       <a href="#"><i class="fab fa-twitter icon fa-2x"></i></a>
                       <span class="float-right">
                           <a href="{{ route('blog.detail') }}">Read More <span><i class="fas fa-arrow-right pt-1"></i></span></a>
                       </span>
                   </div>
               </div>
            </div>
       </div>
       <div class="row px-3 pb-0 pb-md-3">
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="wow pb-2 mb-sm-4">
                   <img src="assests/images/jobs.png" alt="img">
                   <h6 class="px-2">
                       Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   </h6>
                   <p class="px-2">
                       Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                   </p>
                   <div class="px-2">
                       <a href="#"><i class="fab fa-facebook pr-2 icon fa-2x"></i></a>
                       <a href="#"><i class="fab fa-youtube icon pr-2 fa-2x"></i></a>
                       <a href="#"><i class="fab fa-twitter icon fa-2x"></i></a>
                       <span class="float-right">
                           <a href="{{ route('blog.detail') }}">Read More <span><i class="fas fa-arrow-right pt-1"></i></span></a>
                       </span>
                   </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="wow pb-2 mb-sm-4">
                   <img src="assests/images/jobs.png" alt="img">
                   <h6 class="px-2">
                       Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   </h6>
                   <p class="px-2">
                       Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                   </p>
                   <div class="px-2">
                       <a href="#"><i class="fab fa-facebook pr-2 icon fa-2x"></i></a>
                       <a href="#"><i class="fab fa-youtube icon pr-2 fa-2x"></i></a>
                       <a href="#"><i class="fab fa-twitter icon fa-2x"></i></a>
                       <span class="float-right">
                           <a href="{{ route('blog.detail') }}">Read More <span><i class="fas fa-arrow-right pt-1"></i></span></a>
                       </span>
                   </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="wow pb-2 mb-sm-4">
                   <img src="assests/images/jobs.png" alt="img">
                   <h6 class="px-2">
                       Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   </h6>
                   <p class="px-2">
                       Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                   </p>
                   <div class="px-2">
                       <a href="#"><i class="fab fa-facebook pr-2 icon fa-2x"></i></a>
                       <a href="#"><i class="fab fa-youtube icon pr-2 fa-2x"></i></a>
                       <a href="#"><i class="fab fa-twitter icon fa-2x"></i></a>
                       <span class="float-right">
                           <a href="{{ route('blog.detail') }}">Read More <span><i class="fas fa-arrow-right pt-1"></i></span></a>
                       </span>
                   </div>
               </div>
            </div>
       </div>
       <div class="text-center">
           <button type="submit" class="send-btn text-center mt-3">Loading More</button>
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
  .wow{
    border: 1px solid #C7C7C7;
    box-sizing: border-box;
  }
  .wow h6{
    font-weight: 700;
    font-size: 20px;
  }
  .wow p{
    font-weight: 400;
    font-size: 16px;
  }
  .wow img{
    width: 100%;
    height: auto;
  }
  .wow .icon{
    color: #00326F;
  }
  .wow span a{
    color: #f48128;
    font-size: 16px;
  }
  .send-btn {
    font-size: 16px !important;
    background: #F48128 !important;
    height: 35px !important;
    border-radius: 5px !important;
    font-weight: 500;
    color: #ffffff !important;
    padding: 0 5px;
    border: 1px solid #F48128 !important;
}

.send-btn:hover {
    background: #ffffff !important;
    color: #F48128 !important;
}
  a:hover{
    text-decoration: none !important;
  }
</style>