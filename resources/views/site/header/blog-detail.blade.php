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
       <div class="row px-3 wow">
           <a href="{{ route('blogs') }}"><span><i class="fas fa-arrow-left pt-1"></i></span> Back</a>
           <h6 class="px-2">
               Lorem Ipsum is simply dummy text of the printing and typesetting industry.
           </h6>
           <img src="../assests/images/blog-detail.png" alt="img">
           <p class="px-2">
               Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
           </p>
           <div class="px-2 wow">
               <a href="#"><i class="fab fa-facebook pr-2 icon fa-2x"></i></a>
               <a href="#"><i class="fab fa-youtube icon pr-2 fa-2x"></i></a>
               <a href="#"><i class="fab fa-twitter icon fa-2x"></i></a>
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
  .wow a{
    color: #f48128;
    font-size: 16px;
  }
  .wow a:hover{
    text-decoration: none;
    color: #f48128;
  }
</style>