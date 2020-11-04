{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Interview Concierge - Creating New Booking Schedule</div>
    <div class="add_new_job">

        <form method="POST" name="new_job_form" class="new_booking_form newJob job_validation">
            @csrf
            <div class="job_title form_field">
                <span class="form_label">Booking Title :</span>
                <div class="form_input">
                    <input type="text" value="" name="title" class="w100" required>
                    <div id="title_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Company Name :</span>
                <div class="form_input">
                    <input type="text" value="" name="companyname" class="w100" required>
                    <div id="companyname_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Position Name :</span>
                <div class="form_input">
                    <input type="text" value="" name="positionname" class="w100" required>
                    <div id="positionname_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Employer Email :</span>
                <div class="form_input">
                    <input type="email" value="" name="employeremail" class="w100" required>
                    <div id="employeremail_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="job_title form_field">
                <span class="form_label">Booking Password :</span>
                <div class="form_input">
                    <input type="text" value="" name="employerpassword" class="w100" required>
                    <div id="employerpassword_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="job_description form_field" required>
                <span class="form_label">Interview Instruction: </span>
                <div class="form_input">
                    <textarea name="instruction" class="form_editor w100" maxlength="1000" style="min-height: 120px;"></textarea>
                    <div id="instruction_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>



            <div class="job_title form_field">
                <span class="form_label">Additional Managers :</span>
                <div class="form_input">
                    <input type="text" value="" name="additionalmanagers" class="w100" >
                    <div id="additionalmanagers_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


{{--             <div class="job_title form_field">
                <span class="form_label">Number of Slots :</span>
                <div class="form_input">
                    <input type="number" class="jq-number__field" value="1" name="numberofslots" min="1" max="20" class="w20" >

                    <div id="title_error" class="error field_error to_hide">&nbsp;</div>  

                </div>
            </div> --}}

            <h2 class="interSlotHeading">Interview Slots</h2>
 
            <div class="slot form_field">
                <div class="form_input w100">
                    <div class="slots">
                        <div class="slot s1 notbrak leftMargin topMargin">
                            <div class="mb10">Interview Slot 1</div>
                            <div class="time">
                                <div class="notbrak">Time</div>
                                <div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center checkstatus" autocomplete="off" name="slot[1][start]" size="8" required /></div>
                                <div class="notbrak">To</div>
                                <div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" autocomplete="off" name="slot[1][end]" size="8" required /></div>
                            </div>


                            <div class="date topMargin">
                                <span class="notbrak">Date</span>
                                <input type="text" name="date[1]" class="datepicker notbrak checkstatus"  autocomplete="off" size="8" required />
                            </div>
                            <div>
                                <label class="w50 notbrak my10" style="margin-right: 5px;">Maximum number of interviewees:</label>
                                <div class="form_input">
                                    <select name="maximumnumber[1]" class="form_select" >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="checkStatusError hide_it2"> <span>Fill all fields before proceeding to next slot</span> </div>

                    <input type="hidden" name="slotsCounter" id="slotsCounter" value="1">
                    <input type="hidden" name="slotsCounter2" id="slotsCounter2" value="1">
                </div>
            </div>

            <div class="form_field">
                <span class="form_label"></span>
                <div class="form_input">
                    <div class="general_error error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="interviewSlot">
                <button class="btn small violet addSlot"> Add Interview slot</button>
            </div>

            <div class="fomr_btn act_field center">
                {{-- <span class="form_label"></span> --}}
                {{-- <input type="type" value="academic" /> --}}
                <button class="btn small turquoise saveNewBooking">Save</button>
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
    margin-left: 10px;
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


//   ============================================= Code commented for adding new slot on click function =============================================


// $("input[type=number]").bind('keyup input', function(){
//    // alert("fired");
//    console.log("This value",this.value);
//     if(this.value>20 || this.value <1){
//         this.value =1;
//         return 0;
//     }

//     var sC = parseInt($('#slotsCounter').val());
//     console.log("Slot counter",sC);
//     if(sC<this.value){
//     for (i=sC+1; i<=this.value; i++){
//         var slot  = '<div class="slot s'+i+' notbrak leftMargin topMargin">';
//             slot  += '<div class="textCenter">Interview Slot '+i+'</div>';
//             slot  += '<div class="time">';
//             slot  += '<div class="notbrak dynamicTextStyle">Time</div>';
//             slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" name="slot['+i+'][start]" size="8" required /></div>';
//             slot  += '<div class="notbrak dynamicTextStyle">To</div>';
//             slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" name="slot['+i+'][end]" size="8" required /></div>';
//             slot  += '</div>';
//             slot  += '<div class="date topMargin">';
//             slot  += '<span class="notbrak dynamicTextStyle">Date</span>';
//             slot  += '<input type="text" name="date['+i+']" class="datepicker notbrak" size="8" required />';
//             slot  += '</div>';

//             slot  += '<div>';
//                 slot  += '<label class="form_label notbrak" style="margin-right: 5px;">Maximum number of interviewees:</label>';

//                 slot  += '               <div class="form_input">';
//                     slot  += '                  <select name="maximumnumber['+i+']" class="form_select" >';
//                         slot  += '                      <option value="1">1</option>';
//                         slot  += '                       <option value="2">2</option>';
//                         slot  += '                       <option value="3">3</option>';
//                         slot  += '                       <option value="4">4</option>';
//                         slot  += '             <option value="5">5</option>';
//                         slot  += '           <option value="6">6</option>';
//                         slot  += '              <option value="7">7</option>';
//                         slot  += '              <option value="8">8</option>';
//                         slot  += '               <option value="9">9</option>';
//                         slot  += '              <option value="10">10</option>';
//                         slot  += '              <option value="11">11</option>';
//                         slot  += '             <option value="12">12</option>';
//                         slot  += '             <option value="13">13</option>';
//                         slot  += '             <option value="14">14</option>';
//                         slot  += '            <option value="15">15</option>';
//                         slot  += '            <option value="16">16</option>';
//                         slot  += '           <option value="17">17</option>';
//                         slot  += '           <option value="18">18</option>';
//                         slot  += '           <option value="19">19</option>';
//                         slot  += '           <option value="20">20</option>';
//                         slot  += '       </select>';
//                         slot  += '       </div>';
//                         slot  += '   </div>';
//                         slot  += '  </div>';
//             slot  += '</div>';
//             $('.slots').append(slot);
//     }
//     $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
//     $('input.timepicker').timepicker({});
//     $('#slotsCounter').val(this.value);
//     $('input, select').styler();
//     }

//     else if(sC > this.value){

//         for (i=sC; i>this.value; i--){

//             $( ".s"+i ).remove();

//         }

//     $('#slotsCounter').val(this.value);
//     }

// });

//   ============================================= Code commented for adding new slot on click function =============================================

// ============================================= Added new button start =============================================

var i = 2;
$(".addSlot").bind('click', function(){

    var timeValue = $('.checkstatus').val();
    console.log("This is the vlaue" , timeValue);
    if(timeValue != "")
    {

    if(i <= 20){
        i=i;
            var slot  = '<div class="slot s'+i+' notbrak leftMargin topMargin">';
                slot  += '<div class="mb10 dynamicTextStyle">Interview Slot '+i+'</div>';
                slot  += '<div class="time">';
                slot  += '<div class="notbrak dynamicTextStyle">Time</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center checkstatus" autocomplete="off" name="slot['+i+'][start]" size="8" required /></div>';
                slot  += '<div class="notbrak dynamicTextStyle">To</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center checkstatus" autocomplete="off" name="slot['+i+'][end]" size="8" required /></div>';
                slot  += '</div>';
                slot  += '<div class="date topMargin">';
                slot  += '<span class="notbrak dynamicTextStyle">Date</span>';
                slot  += '<input type="text" name="date['+i+']" class="datepicker notbrak checkstatus" autocomplete="off" size="8" required />';
                slot  += '</div>';

                slot  += '<div>';
                    slot  += '<label class="w50 notbrak my10" style="margin-left: 5px;">Maximum number of interviewees:</label>';

                    slot  += '               <div class="form_input">';
                        slot  += '                  <select name="maximumnumber['+i+']" class="form_select" >';
                            slot  += '                      <option value="1">1</option>';
                            slot  += '                       <option value="2">2</option>';
                            slot  += '                       <option value="3">3</option>';
                            slot  += '                       <option value="4">4</option>';
                            slot  += '             <option value="5">5</option>';
                            slot  += '           <option value="6">6</option>';
                            slot  += '              <option value="7">7</option>';
                            slot  += '              <option value="8">8</option>';
                            slot  += '               <option value="9">9</option>';
                            slot  += '              <option value="10">10</option>';
                            slot  += '              <option value="11">11</option>';
                            slot  += '             <option value="12">12</option>';
                            slot  += '             <option value="13">13</option>';
                            slot  += '             <option value="14">14</option>';
                            slot  += '            <option value="15">15</option>';
                            slot  += '            <option value="16">16</option>';
                            slot  += '           <option value="17">17</option>';
                            slot  += '           <option value="18">18</option>';
                            slot  += '           <option value="19">19</option>';
                            slot  += '           <option value="20">20</option>';
                            slot  += '       </select>';
                            slot  += '       </div>';
                            slot  += '   </div>';
                            slot  += '  </div>';
                slot  += '</div>';
                slot  += '<div class="checkStatusError hide_it2"> <span>Fill all fields before proceeding to next slot</span> </div>';

        $('.slots').append(slot);
        $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
        $('input.timepicker').timepicker({});
        $('#slotsCounter').val(this.value);
        $('input, select').styler();
     i++;
    }
 
    else  {
        return false;
    }

}

else{

    timeValue = '';
    $( ".checkStatusError" ).show().delay(4000).fadeOut('slow');
    console.log(timeValue);
}

// $('.checkStatusError').fadeOut('slow').delay(3000).hide(0);
// $('.checkStatusError').fadeIn('slow').delay(1000).hide(0);

});

// ============================================= Add new buttton end here =============================================

$(document).ready(function(){
    $('input.timepicker').timepicker({});
    $('input, select').styler();
$('.saveNewBooking').on('click',function() {
event.preventDefault();
var formData = $('.new_booking_form').serializeArray();
$('.saveNewBooking').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
console.log(' formData ', formData);
$('.general_error').html('');
$.ajax({
    type: 'POST',
    url: base_url+'/ajax/booking/new',
    data: formData,
    success: function(data){
        console.log(' data ', data);
        $('.saveNewBooking').html('Save').prop('disabled',false);
        if( data.status == 1 ){
            window.location.replace(data.route);
        }else{
            $('.general_error').html('<p>Fill all required fields</p>').removeClass('to_hide').addClass('to_show');
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
                            $('#'+key+'_error').removeClass('to_show').addClass('to_hide').text(data.validator[key][0]);
                        }
                    }
                }
                    ,3000);
            }
           if(data.error != undefined){
             $('.general_error').append(data.error);
           }
           setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
        }

    }
});
});
});

</script>
@stop

