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
             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
           </p>
           <p>
             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
           </p>
           <h3 class="pt-5 pb-2">Mission</h3>
           <p>
             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
           </p>
           <h3 class="pt-5 pb-2">Vission</h3>
           <p>
             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
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