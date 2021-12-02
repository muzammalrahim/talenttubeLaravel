{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')
@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop
@section('content')
<div class="newJobCont profile profile-section">
   <h2 class="head icon_head_browse_matches">Editing a Booking Schedule</h2>
   <div class="add_new_job">
      <form method="POST" name="login_booking_form" class="login_booking_form newJob job_validation">
         @csrf
         {{-- <div class="job_title form_field filter-section">
            <span class="form_label fw-bold fs-5">Booking ID :</span>
            <div class="form_input">
               <input type="text" value="" name="bookingid" class="w30 bg-white" placeholder="Please enter the booking Id" required>
               <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
               <button class="btn small turquoise loginEditInterview orange_btn " style="height: 43px !important;">Login</button>
            </div>
         </div> --}}

         <div class="form-group row filter-section">
            <label for="email" class="col-sm-2 col-form-label">Mobile :</label>
            <div class="col-sm-8">
               <input type="text" value="" id="email" name="bookingid" class="form-control bg-white" placeholder="Please enter the booking Id" required>
               <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
            </div>
               <button class="col-sm-2 loginEditInterview orange_btn">Login</button>
         </div>
         {{-- 
         <div class="job_title form_field w20">
            <span class="form_label textCenter">Or</span>
         </div>
         <div class="job_title form_field">
            <span class="form_label">Email </span>
            <div class="form_input">
               <input type="email" value="" name="email" class="w20" required>
               <div id="email_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="job_title form_field">
            <span class="form_label">Password </span>
            <div class="form_input">
               <input type="password" value="" name="password" class="w20" required>
               <div id="password_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div>
         <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
               <div class="general_error error to_hide">&nbsp;</div>
            </div>
         </div>
         --}}
         <div class="fomr_btn act_field">
            <span class="form_label"></span>
            {{-- <input type="type" value="academic" /> --}}
         </div>
      </form>
   </div>
   <div class="cl"></div>
</div>
@stop
@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}">
--}}
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
--}}
<style>

</style>
@stop
@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> --}}
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}
<script type="text/javascript">
   $('.loginEditInterview').on('click',function() {
   
   event.preventDefault();
   var formData = $('.login_booking_form').serializeArray();
   // $('.loginEditInterview').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
   console.log(' formData ', formData);
   $('.general_error').html('');
   $.ajax({
       type: 'POST',
       url: base_url+'/ajax/booking/firstlogin',
       data: formData,
       success: function(data){
           console.log(' data ', data);
           $('.loginEditInterview').html('Save').prop('disabled',false);
           if( data.status == 1 ){
               window.location.replace(data.route);
           }else{
   
               if(data.validator != undefined){
                   const keys = Object.keys(data.validator);
                   for (const key of keys) {
                       if($('#'+key+'_error').length > 0){
                           $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                       }
                   }
   
                   setTimeout(() => {
                       for (const key of keys) {
                           if($('#'+key+'_error').length > 0){
                               $('#'+key+'_error').removeClass('to_show').addClass('to_hide');
                           }
                       }
                   }
                       ,3000);
               }
              if(data.error != undefined){
                //$('.general_error').html('<p>Error Creating new Booking</p>').removeClass('to_hide').addClass('to_show');
                $('.general_error').append(data.error);
              }
              setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
           }
   
       }
   });
   });
   
   
</script>
@stop