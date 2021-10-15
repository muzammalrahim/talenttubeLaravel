@extends('site.employer.employermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop
@section('content')
<div class="newJobCont">
   <div class="head icon_head_browse_matches">Interview Invitaion Detail</div>
   @if ($UserInterview->status =='pending')
   <div class="job_row interviewBookingsRow_{{$UserInterview->id}}">
      <div class="job_heading p10">
         <div class="w_80p">
            <h3 class=" job_title"><a> <b>Invitation 1: </b> Inerview from {{$UserInterview->employer->company}}</a></h3>
         </div>
         <div class="fl_right">
            <div class="j_label bold">Status:</div>
            <div class="j_value text_capital"> {{$UserInterview->status}} </div>
         </div>
      </div>
      <div class="job_info row p10 dblock">
         <div class="IndustrySelect mb20">
            {{-- 
            <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
            --}}
            @if ($UserInterview->template->type = 'phone_screeen')
            <p class="p0 qualifType"> Interview Type: <b> Phone Screen</b> </p>
            @else
            <p class="p0 qualifType"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
            @endif
         </div>
         <div class="actionButton">
            <button class="btn small leftMargin turquoise acceptButton" data_url = "{{$UserInterview->url}}">Accept</button>
            <button class="btn small leftMargin turquoise rejectButton ml20" data_url = "{{$UserInterview->url}}">Reject</button>
         </div>
         <p class="errorsInFields"></p>
      </div>
   </div>
   @else
   <h3> You have already responded to this interview </h3>
   @endif
   <div class="cl"></div>
</div>
@stop
@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}">
--}}
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
--}}
<style>
   .button {
   background-color: rgb(31, 120, 236);
   border-radius: 5px;
   color: white;
   padding: .5em;
   text-decoration: none;
   margin-top: 20px !important;
   margin-bottom: 20px !important;
   display:block
   }
   .button:focus,
   .button:hover {
   background-color: rgb(52, 49, 238);
   color: White;
   }
</style>
@stop
@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}
<script type="text/javascript">
   $('.acceptButton').on('click',function() {
     event.preventDefault();
     var acceptUrl = $(this).attr('data_url');
   
       $('.acceptButton').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
       $('.general_error1').html('');
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
   
       $.ajax({
           type: 'POST',
           url: base_url+'/ajax/accept/interview/invitation',
            data:{url:acceptUrl},
   
           success: function(data){
               console.log(' data ', data);
               $('.acceptButton').html('Accepted').prop('disabled',false);
               if( data.status == 1 ){
                   $('.errorsInFields').text('Interview accepted successfully');
                   setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                   window.location.href = "{{ route('intetviewInvitation')}}" ;
   
               }else{
                   // $('.errorsInFields').text('Error occured');
                  setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
               }
   
           }
       });
   
   });
   
   
   
   $('.rejectButton').on('click',function() {
       event.preventDefault();
       // var formData = $('.crossReference').serializeArray();
       var rejectUrl = $(this).attr('data_url');
   
       $('.rejectButton').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
       // console.log(' formData ', formData);
       $('.general_error1').html('');
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
   
       $.ajax({
           type: 'POST',
           url: base_url+'/ajax/reject/interview/invitation',
           // data: formData,
            data:{url:rejectUrl},
   
           success: function(data){
               console.log(' data ', data);
               $('.rejectButton').html('Rejected').prop('disabled',false);
               if( data.status == 1 ){
                   $('.errorsInFields').text('Interview rejected successfully');
                   setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                   window.location.href = "{{ route('intetviewInvitation')}}" ;
               }else{
                   // $('.errorsInFields').text('Error occured');
                  setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
               }
   
           }
       });
   });
   
</script>
@stop