{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')

@section('content')

<div class="card newJobCont">
   <div class="card-header responsive_header font-weight-bold  jobAppHeader icon_head_browse_matches head_concierge_botmline">Editing a Booking Schedule</div>
   <div class="card-body c_bg">
      <div class="add_new_job">
         <form method="POST" name="login_booking_form" class="login_booking_form newJob job_validation">
            @csrf
            <div class="form-group row">
               <label class="col-sm-2 col-form-label ">Booking ID</label>
               <div class="col-sm-10">
                  <input type="text" name="bookingid" class="form-control" value=""  >
                  <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
               </div>
            </div>
            <div class="job_title textCen marginB form_field w20">
               <span class="form_label  ">Or</span>
            </div>
            <div class="form-group row job_title form_field">
               <label class="col-sm-2 col-form-label">Email </label>
               <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" value="" required>
                  <div id="email_error" class="error field_error to_hide">&nbsp;</div>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Password  </label>
               <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" value="" required>
                  <div id="password_error" class="error field_error to_hide">&nbsp;</div>
               </div>
            </div>
            <div class="form_field">
               <span class="form_label"></span>
               <div class="form_input">
                  <div class="general_error error to_hide">&nbsp;</div>
               </div>
            </div>
            <div class="fomr_btn act_field text-center">
               <span class="form_label"></span>
               {{-- <input type="type" value="academic" /> --}}
               <button class="btn btn-cyan btn-sm loginEditInterview">Login</button>
            </div>
         </form>
      </div>
      <div class="cl"></div>
   </div>
</div>

@stop

@section('custom_footer_css')

<style>


</style>
@stop

@section('custom_js')

<script type="text/javascript">

$('.loginEditInterview').on('click',function() {

console.log('clicked on interview button');

event.preventDefault();
var formData = $('.login_booking_form').serializeArray();
// $('.loginEditInterview').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
console.log(' formData ', formData);
$('.general_error').html('');
$.ajax({
    type: 'POST',
    url: base_url+'/m/ajax/booking/firstlogin',
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

