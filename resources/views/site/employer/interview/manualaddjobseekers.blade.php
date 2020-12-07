{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Manual Invitation</div>
    @php
    session()->put('bookingid',$interview->id);
    @endphp
    <a class="button btn btn-info btn-rounded" href="{{route('interviewconcierge.created')}}">Go Back</a>
			
    <div class="add_new_job">

        <form method="POST" name="login_booking_form1" class="login_booking_form1 newJob job_validation">
            @csrf
            <div class="job_title form_field">
                <span class="form_label">Name :</span>
                <div class="form_input">
                    <input type="text" value="" name="name" class="w20" required>
                    <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Mobile :</span>
                <div class="form_input">
                    <input type="text" value="" name="mobile" class="w20" required>
                    <div id="password_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Email :</span>
                <div class="form_input">
                    <input type="email" value="" name="email" class="w20" required>
                    <div id="email_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

        <input type="hidden" value="{{$interview->url}}" name="url" class="w20" required>

        <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
                <div class="general_error1 error to_hide">&nbsp;</div>
            </div>
        </div>

            <div class="fomr_btn act_field">
                <button class="btn small leftMargin turquoise loginEditInterview1">Send Notification</button>
            </div>

        </form>
        </div>


        <div class="add_new_job ">

            <form method="POST" name="login_booking_form2" class="login_booking_form2 newJob job_validation ">
                @csrf
                <div class="job_title form_field">
                    <span class="form_label">Name :</span>
                    <div class="form_input">
                        <input type="text" value="" name="bookingid" class="w20" required>
                        <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>


                <div class="job_title form_field">
                    <span class="form_label">Mobile :</span>
                    <div class="form_input">
                        <input type="text" value="" name="mobile" class="w20" required>
                        <div id="password_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>


                <div class="job_title form_field">
                    <span class="form_label">Email :</span>
                    <div class="form_input">
                        <input type="email" value="" name="email" class="w20" required>
                        <div id="email_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>



            <div class="form_field">
                <span class="form_label"></span>
                <div class="form_input">
                    <div class="genera2_error error to_hide">&nbsp;</div>
                </div>
            </div>

                <div class="fomr_btn act_field">

                    {{-- <input type="type" value="academic" /> --}}
                    <button class="btn small leftMargin turquoise loginEditInterview2">Sed Notification</button>
                </div>

            </form>
            </div>

            <div class="add_new_job ">

                <form method="POST" name="login_booking_form3" class="login_booking_form3 newJob job_validation ">
                    @csrf
                    <div class="job_title form_field">
                        <span class="form_label">Name :</span>
                        <div class="form_input">
                            <input type="text" value="" name="name" class="w20" required>
                            <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
                        </div>
                    </div>


                    <div class="job_title form_field">
                        <span class="form_label">Mobile :</span>
                        <div class="form_input">
                            <input type="text" value="" name="mobile" class="w20" required>
                            <div id="password_error" class="error field_error to_hide">&nbsp;</div>
                        </div>
                    </div>


                    <div class="job_title form_field">
                        <span class="form_label">Email :</span>
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

                        {{-- <input type="type" value="academic" /> --}}
                        <button class="btn small leftMargin turquoise loginEditInterview3">Send Notification</button>
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

{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}

<style>
.notbrak{
    display: inline-block;
}

.leftMargin{
    margin-left: 5%;
}

.topMargin{
    margin-top: 10px;
}

.textCenter{
   margin-left: 40%;
   padding-bottom: 10px !important;
}

.dynamicTextStyle{
    margin-left: 5px;
    margin-right: 5px;
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
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">

$('.loginEditInterview1').on('click',function() {

event.preventDefault();
var formData = $('.login_booking_form1').serializeArray();
$('.loginEditInterview1').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
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
var formData = $('.login_booking_form1').serializeArray();
$('.loginEditInterview2').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
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
$('.loginEditInterview3').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
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

