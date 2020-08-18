@extends('mobile.master')

@section('title', $title)

@section('classes_body', 'homepage')

@section('body')

<!-- main -->
<div class="main  ">
<div class="homeBg">
   
   <div class="wrapper">
    @include('site.header')
   </div>



 <div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center text-center">
   <form id="frm_join_index_step_1" action="{{route('mJoin')}}" method="POST" class="col-12">
      @csrf

      <div class="form-label-group">
         <a href="{{route('homepage')}}"><img id="logo_main_page" src="{{asset('/images/site/header_impact.png')}}" style="width: 80%;" alt="" /></a>
      </div>

      <div class="form-label-group">
         <p class="h4 mb-4 text-white">Join the best Talent Matcher in the world.</p>
      </div>

      
      <div class="form-label-group">
         <p class="h4 mb-4 text-white">I am a</p>
      </div>

      <div class="form-label-group">
       
       <select name="type" class="custom-select mb-3">
               <option value="user" selected="selected">Job Seeker</option>
               <option value="employer" >Employer</option>
         </select>

      </div>   

    <div class="form-label-group">
      <button type="submit" class="btn pink text-white">Continue</button>
    </div>

   </form>

   
  </div>  
</div>

 


</div>
</div>
<!-- /main -->


@stop

@section('custom_js')

@stop

@section('custom_footer_css')

<link rel="stylesheet" href="{{ asset('css/mobile/homepage.css') }}">

<style type="text/css">

</style>

@stop
