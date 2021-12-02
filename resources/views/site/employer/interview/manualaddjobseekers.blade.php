{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop
@section('content')
<div class="profile profile-section">
   {{-- <div class="head icon_head_browse_matches">Manual Invitation</div> --}}
   <h2 class="head icon_head_browse_matches">Manual Invitation</h2>
   @php
   session()->put('bookingid',$interview->id);
   @endphp
   <div class="my-3">
      <a class="blue_btn px-2 py-1" href="{{route('interviewconcierge.created')}}">Go Back</a>
   </div>
   <div class="add_new_job">
      <form method="POST" name="login_booking_form1" class="login_booking_form1 newJob job_validation">
         @csrf
         <div class="form-group row">
            {{-- <span class="label">Name :</span> --}}
            <label for="staticEmail" class="col-sm-2 col-form-label">Name :</label>
            <div class="col-sm-10">
               <input type="text" value="" name="name" id="staticEmail" class="form-control" required>
               <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>

         <div class="form-group row">
            <label for="mobile" class="col-sm-2 col-form-label">Mobile :</label>
            <div class="col-sm-10">
               <input type="text" value="" id="mobile" name="mobile" class="form-control" required>
               <div id="password_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>

         <div class="form-group row">
            {{-- <span class="form_label">Email :</span> --}}
            <label for="email" class="col-sm-2 col-form-label">Email :</label>

            <div class="col-sm-10">
               <input type="email" value="" id="email" name="email" class="form-control" required>
               <div id="email_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <input type="hidden" value="{{$interview->url}}" name="url" class="w20" required>
         <input type="hidden" value="{{$interview->positionname}}" name="positionname" class="w20" required>
         <input type="hidden" value="{{$interview->employerData->company}}" name="employerName" class="w20" required>
         <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
               <div class="general_error1 error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="fomr_btn act_field">
            <button class="blue_btn loginEditInterview1">Send Notification</button>
         </div>
      </form>
   </div>
   <div class="add_new_job ">
      <form method="POST" name="login_booking_form2" class="login_booking_form2 newJob job_validation ">
         @csrf
         <div class="form-group row">
            {{-- <span class="form_label">Name :</span> --}}
            <label for="name1" class="col-sm-2 col-form-label">Mobile :</label>
            <div class="col-sm-10">
               <input type="text" value="" id="name1" name="bookingid" class="form-control" required>
               <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form-group row">
            {{-- <span class="form_label">Mobile :</span> --}}
            <label for="mobile1" class="col-sm-2 col-form-label">Mobile :</label>

            <div class="col-sm-10">
               <input type="text" value="" id="mobile1" name="mobile" class="form-control" required>
               <div id="password_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form-group row">
            {{-- <span class="form_label">Email :</span> --}}
            <label for="email1" class="col-sm-2 col-form-label">Email :</label>

            <div class="col-sm-10">
               <input type="email" value="" id="email1" name="email" class="form-control" required>
               <div id="email_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
               <div class="general_error2 error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="fomr_btn act_field">
            {{-- <input type="type" value="academic" /> --}}
            <button class="blue_btn loginEditInterview2">Sed Notification</button>
         </div>
      </form>
   </div>
   <div class="add_new_job ">
      <form method="POST" name="login_booking_form3" class="login_booking_form3 newJob job_validation ">
         @csrf
         <div class="form-group row">
            {{-- <span class="form_label">Name :</span> --}}
            <label for="name2" class="col-sm-2 col-form-label">Name :</label>

            <div class="col-sm-10">
               <input type="text" value="" id="name2" name="name" class="form-control" required>
               <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form-group row">
            {{-- <span class="form_label">Mobile :</span> --}}
            <label for="mobile2" class="col-sm-2 col-form-label">Mobile :</label>
            <div class="col-sm-10">
               <input type="text" value="" id="mobile2" name="mobile" class="form-control" required>
               <div id="password_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form-group row">
            {{-- <span class="form_label">Email :</span> --}}
            <label for="email2" class="col-sm-2 col-form-label">Email :</label>

            <div class="col-sm-10">
               <input type="email" value="" id="email2" name="email" class="form-control" required>
               <div id="email_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
               <div class="general_error3 error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="fomr_btn act_field">
            {{-- <input type="type" value="academic" /> --}}
            <button class="blue_btn loginEditInterview3">Send Notification</button>
         </div>
      </form>
   </div>
   <div class="cl"></div>
</div>
@stop
@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}">
--}}
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
--}}
<style>
   .notbrak{
   display: inline-block;
   }
   .leftMargin{
   margin-left: 5%;
   }
   .button {
   background-color: rgb(214, 90, 32);
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
   background-color: rgb(231, 27, 13);
   color: White;
   }
</style>
@stop
@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
   $('.loginEditInterview1').on('click',function() {
   
   event.preventDefault();
   var formData = $('.login_booking_form1').serializeArray();
   // $('.loginEditInterview1').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
   console.log(' formData ', formData);
   $('.general_error1').html('');
   $.ajax({
       type: 'POST',
       url: base_url+'/ajax/booking/manualsendnotification',
       data: formData,
       success: function(data){
           console.log(' data ', data);
           $('.loginEditInterview1').html('Save').prop('disabled',false);
           if( data.status == 1 ){
               $('.general_error1').removeClass('to_hide').addClass('to_show').text('Notification sent sucessfully');
               setTimeout(() => { $('.general_error1').removeClass('to_show').addClass('to_hide').text(''); },3000);
           }else{
               $('.general_error1').removeClass('to_hide').addClass('to_show').text('Error occured');
              setTimeout(() => { $('.general_error1').removeClass('to_show').addClass('to_hide').text(''); },3000);
           }
   
       }
   });
   });
   
   
   $('.loginEditInterview2').on('click',function() {
   
   event.preventDefault();
   var formData = $('.login_booking_form2').serializeArray();
   // $('.loginEditInterview2').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
   console.log(' formData ', formData);
   $('.general_error2').html('');
   $.ajax({
       type: 'POST',
       url: base_url+'/ajax/booking/manualsendnotification',
       data: formData,
       success: function(data){
           console.log(' data ', data);
           $('.loginEditInterview2').html('Save').prop('disabled',false);
           if( data.status == 1 ){
               $('.general_error2').removeClass('to_hide').addClass('to_show').text('Notification sent sucessfully');
   
               setTimeout(() => { $('.general_error2').removeClass('to_show').addClass('to_hide').text(''); },3000);
           }else{
               $('.general_error2').removeClass('to_hide').addClass('to_show').text('Error occured');
              setTimeout(() => { $('.general_error2').removeClass('to_show').addClass('to_hide').text(''); },3000);
           }
   
       }
   });
   });
   
   
   
   $('.loginEditInterview3').on('click',function() {
   
   event.preventDefault();
   var formData = $('.login_booking_form1').serializeArray();
   // $('.loginEditInterview3').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
   console.log(' formData ', formData);
   $('.general_error3').html('');
   $.ajax({
       type: 'POST',
       url: base_url+'/ajax/booking/manualsendnotification',
       data: formData,
       success: function(data){
           console.log(' data ', data);
           $('.loginEditInterview3').html('Save').prop('disabled',false);
           if( data.status == 1 ){
               $('.general_error3').removeClass('to_hide').addClass('to_show').text('Notification sent sucessfully');
   
               setTimeout(() => { $('.general_error3').removeClass('to_show').addClass('to_hide').text(''); },3000);
           }else{
               $('.general_error3').removeClass('to_hide').addClass('to_show').text('Error occured');
              setTimeout(() => { $('.general_error3').removeClass('to_show').addClass('to_hide').text(''); },3000);
           }
   
       }
   });
   });
   
   
   
   
   
</script>
@stop