{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('classes_body', 'homepage')

@section('body')


<!-- main -->
<div class="main  ">
   <!-- wrapper -->
   <div class="wrapper">

    @include('site.header')


<!-- header_cont  -->
<div class="wrap_header_cont absolute">
   <!-- header_cont_bl -->
   <div class="bl">
      <div class="bl_logo">
        {{-- <a href="{{route('homepage')}}"><img id="logo_main_page" src="{{asset('/images/site/header_impact.png')}}" style="height:44px;" alt="" /></a> --}}
        <a href="{{route('homepage')}}"><img id="logo_main_page" src="https://talenttube.tv/wp-content/themes/talenttube/images/talenttube.png" alt="" /></a>


      </div>
      <div class="bl_join_done">
         <div class="slogan">Please login to your account to see the interview</div>
         {{-- <form id="frm_join_index_step_1" action="{{route('join')}}" method="POST">
            @csrf
            <div class="bl_form bl_form_index">
               <label class="valign-middle">I am a</label>
               <div class="bl_select">
                  <select id="bl_join_done_orientation" name="type" class="select_main select_index">
                     <option value="user" selected="selected">Job Seeker</option>
                     <option value="employer" >Employer</option>
                  </select>
               </div>
               <button type="submit" class="btn pink">Continue</button>
            </div>
         </form> --}}
      </div>
      <!-- not page join2-->
   </div>
   <!-- header_cont_bl -->
</div>
<!-- /header_cont  -->


    <!-- content -->
      <div class="content">
         <div class="cont_w">
            <div class="bl_main_info">
               <div class="item">
                  <div class="pic">
                     <img src="{{asset('/images/site/homepage/pic_clock.png')}}" width="128" height="128" alt="" />
                  </div>
                  <p>Signing up takes two minutes and is totally free.</p>
               </div>
               <div class="item">
                  <div class="pic">
                     <img src="{{asset('/images/site/homepage/pic_heart.png')}}" width="128" height="104" alt="" />
                  </div>
                  <p>Our matching algorithm helps to find the right people.</p>
               </div>
               <div class="item">
                  <div class="pic">
                     <img src="{{asset('/images/site/homepage/pic_chat.png')}}" width="128" height="112" alt="" />
                  </div>
                  <p>Find your dream job here!</p>
               </div>
            </div>
            <div class="cl"></div>
         </div>
      </div>
      <!-- /content -->
   </div>
   <!-- /wrapper -->


   @include('site.interviewInvitation.login')

   @include('site.home.interviewLogin')

   @include('site.footer')



</div>
<!-- /main -->


@stop


@section('custom_js')

<script type="text/javascript">
	 
	 
$(function () {
    var $ppSignIn=$('#pp_sign_in').modalPopup({shClass: ''});

        $ppSignIn.open();
    
    function signInClose() {
        if(!$ppSignIn.is(':visible'))return;
        $ppSignIn.close(false,function(){
            // hideErrorLoginFrom('#form_login_user', $('input.inp, #form_login_submit, button', '#form_login'))
        })
    }

    $('#pp_sign_in_close').click(function(){
        signInClose();
        return false;
    })

    $('#pp_sign_in_open').click(function(){
        console.log(' open ');
        $ppSignIn.open();
        return false;
    })

});







</script>

<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>
@stop

<style type="text/css">
	
	.interviewConcierge{display: none;}
</style>