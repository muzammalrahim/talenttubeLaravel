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
       <h2 class="text-center">Contact Us </h2>
       <form class="contact-form mt-5" method="post" autocomplete="on" >
        {{-- action="{{route('login')}}" --}}
        @csrf
        <div class="row px-2">
          <div class="col-12 col-sm-6 py-2 wow">
            <label for="fullName">Name</label>
            <input type="text" id="fullName" class="form-control" placeholder="Enter Full name..">
          </div>
          <div class="col-12 col-sm-6 py-2 wow">
            <label for="emailAddress">Email</label>
            <input type="email" id="emailAddress" class="form-control" placeholder="Enter Email..">
          </div>
        </div>
        <div class="row px-2">  
          <div class="col-12 py-2 wow">
            <label for="subject">Contact Number</label>
            <input type="number" id="number" class="form-control" placeholder="Enter Number..">
          </div>
          <div class="col-12 py-2 wow">
            <label for="message">Message</label>
            <textarea id="message" class="form-control" rows="4" placeholder="Enter Message.."></textarea>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="send-btn mt-3">Send</button>
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

    

{{-- <script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script> --}}

<script src="{{ asset('assests/bootstrap/js/jquery.js') }}"></script>
<script src="{{ asset('assests/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assests/bootstrap/js/bootstrap.min.js')}}"></script>

@stop

<style type="text/css">
  .Content .signin{
    width: 60% !important;
  }
  .Content .logo{
    padding: 30px 0px !important;
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

  .wow label{
    font-weight: 400;
    font-size: 16px;
  }
  .wow input{
    background-color: #F5F5F5;
  }
  .wow textarea{
    background-color: #F5F5F5;
  }
</style>