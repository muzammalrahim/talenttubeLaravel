{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Welcome to Interview Concierge</div>

    {{-- @dump($interview); --}}
    <div class="add_new_job">

        <form method="POST" name="login_booking_form" class="login_booking_form newJob job_validation">
            @csrf
            <div class="job_title form_field">
                <span class="form_label">Mobile:</span>
                <div class="form_input">
                    <input type="text" value="" name="bookingid" class="w20" required>
                    <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="job_title form_field">
                <span class="form_label">Email:</span>
                <div class="form_input">
                    <input type="email" value="" name="email" class="w20" required>
                    <div id="email_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="form_field">
                <span class="form_label"></span>
                <div class="form_input">
                    <div class="general_error error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="fomr_btn act_field">
                <span class="form_label"></span>
                <button class="btn small turquoise loginEditInterview">Login</button>
            </div>

        </form>
        </div>



<div class="cl"></div>
</div>




@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
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

$('.loginEditInterview').on('click',function() {

event.preventDefault();
var formData = $('.login_booking_form').serializeArray();
$('.loginEditInterview').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
console.log(' formData ', formData);
$('.general_error').html('');
$.ajax({
    type: 'POST',
    url: base_url+'/ajax/userbooking/login',
    data: formData,
    success: function(data){

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

