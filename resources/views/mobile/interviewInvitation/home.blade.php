@extends('mobile.master')

@section('title', $title)

@section('classes_body', 'homepage')

@section('body')

<!-- main -->
<div class="main  ">
<div class="homeBg">
   
   <div class="wrapper">
    @include('mobile.header.header1')
   </div>



 <div class="container mt-5">
  <div class="row h-100 justify-content-center align-items-center text-center">
   {{-- <form id="frm_join_index_step_1" action="{{route('mJoin')}}" method="POST" class="col-12">
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

   </form> --}}


    <p class="interviewInvitationText text-white"> Please login to your account to see the interview </p>


   
  </div>  
</div>

  
   @include('mobile.interviewInvitation.interviewInvitationLogin') 


</div>

{{-- @include('site.home.login') --}}

@include('mobile.footer')
</div>
<!-- /main -->


@stop

@section('custom_js')
  <script type="text/javascript" >
    
    $(document).ready(function(){
        $("#mLoginModal").modal('show');
    });

    $('.interviewInvitationSignInBtn').on('click',function() {
        console.log(' interviewInvitationSignInBtn click ');
        $('.loginStatus').html('');
        $('.mProcessing').removeClass('d-none');
        $('#m_form_login').addClass('d-none');
        var formData = $('#m_form_login').serialize();
        console.log(' formData ', formData);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
         $.ajax({
             url: base_url+'/loginUserInterviewInvitation',
             type : 'POST',
             data : formData,
             success : function(resp) {
                 var signinError = resp.message;
                 $('.loginStatus').text(signinError);
                 
                 if(resp.status){
                     setTimeout(() => {
                         location.href = resp.redirect;
                     }, 1000);
                 }else{
                    $('.mProcessing').addClass('d-none');
                    $('#m_form_login').removeClass('d-none');
                    location.reload();
                    if(resp.message && resp.message.email){
                        $('.loginStatus').html('<p>'+resp.message.email+'</p>');
                    }
                    if(resp.message && resp.message.password){
                        $('.loginStatus').html('<p>'+resp.message.password+'</p>');
                    }
                 }
             }
         });

    });



  </script>
@stop

@section('custom_footer_css')

<link rel="stylesheet" href="{{ asset('css/mobile/homepage.css') }}">

<style type="text/css">

  .interviewConcierge{display: none;}
  .interviewInvitationText{margin: 0;position: absolute;top: 30%;left: 50%;-ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);color: #e0e0e0;text-shadow: 2px 2px black;}

</style>

@stop
