{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')


@section('content')

<div class="card .border-info mb-3 bg-white rounded newJobCont">
   <div class="card-header reponsive_header jobAppHeader icon_head_browse_matches head_concierge_botmline">Interview Concierge - Editing Booking Schedule</div>
   <div style="background: #dddfe3;" class="card-body add_new_job">
      <form method="POST" name="new_job_form" class="new_booking_form newJob job_validation">
            @csrf
            

            <div class="job_title form_field">
                <span class="form_label">Booking ID :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->uniquedigits}}" name="uniquedigits" class="w100" >
                    <div id="additionalmanagers_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>
            <input type="hidden" name="intervieww_id" value="{{$interview->id}}">
            <p class="errorBookinId hide_it2"></p>
            <p class="bookedSuccessfully"></p>
            <div class="fomr_btn act_field center">
                <button class="btn btn-sm btn-primary updateNewBooking ">Update</button>
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


$('input.datepicker').datepicker({
// Escape any “rule” characters with an exclamation mark (!).
format: 'You selecte!d: dddd, dd mmm, yyyy',
formatSubmit: 'yyyy/mm/dd',
hiddenPrefix: 'prefix__',
hiddenSuffix: '__suffix'
})



$(document).ready(function(){

    $('.updateNewBooking').on('click',function() {
        event.preventDefault();
        var formData = $('.new_booking_form').serializeArray();
        // $('.updateNewBooking').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
        console.log(' formData ', formData);
        $('.general_error').html('');
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/update/MunidigitEditUpdate',
            data: formData,
            success: function(data){
                // console.log(' data ', data);
                // $('.updateNewBooking').html('Save').prop('disabled',false);
                if( data.status == 1 ){

                    var bookedSuccessfully =  data.message;
                    $('.bookedSuccessfully').text(bookedSuccessfully);
                    $('.errorBookinId').addClass('hide_it2');
                    location.href = base_url+'/m/Minterviewconcierge';
                }else{
                        var stringfy = data['validator'];
                        var sringobj = JSON.stringify(stringfy);
                        var obj = JSON.parse(sringobj);
                        var uniqID =obj.uniquedigits[0] ;
                        // console.log(uniqID);
                        $('.errorBookinId').text(uniqID);
                        $('.errorBookinId').toggleClass('hide_it2');
                           window.setTimeout(function(){
                            ('.errorBookinId').addClass('hide_it2');
                        }, 3000);

                }

            }
        });
    });

});


</script>
@stop

