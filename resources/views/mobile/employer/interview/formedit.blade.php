{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')


@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Interview Concierge - Editing Booking Schedule</div>
    <div class="add_new_job">

        <form method="POST" name="new_job_form" class="new_booking_form newJob job_validation">
            @csrf
            <div class="job_title form_field">
                <span class="form_label">Booking Title :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->title}}" name="title" class="w100" required>
                    <div id="title_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Company Name :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->companyname}}" name="companyname" class="w100" required>
                    <div id="companyname_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Position Name :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->positionname}}" name="positionname" class="w100" required>
                    <div id="positionname_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Employer Email :</span>
                <div class="form_input">
                    <input type="email" value="{{$interview->employeremail}}" name="employeremail" class="w100" required>
                    <div id="employeremail_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="job_title form_field">
                <span class="form_label">Booking Password :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->employerpassword}}" name="employerpassword" class="w100" required>
                    <div id="bookingpassword_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

            <div class="job_description form_field" required>
                <span class="form_label">Interview Instruction: </span>
                <div class="form_input">
                    <textarea name="instruction" class="form_editor w100" maxlength="1000" style="min-height: 120px;">{{$interview->instruction}}</textarea>
                    <div id="instruction_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>



            <div class="job_title form_field">
                <span class="form_label">Additional Managers :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->additionalmanagers}}" name="additionalmanagers" class="w100" >
                    <div id="additionalmanagers_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="slot form_field">
                <label class="form_label">Interview Slots:</label>
                <div class="form_input w100">
                    <div class="slots">
                        @php
                        $slots = $interview->slots;
                        @endphp
                        @foreach ($slots as $key => $slot)
                        

                        <div class="slot s{{$key+1}} notbrak m_rb20">
                            <div class="textCenter2">Interview Slot <span class="test">{{$key+1}}</span> 
                                <i class="fas fa-trash fl_right deleteSlot"></i>
                            </div>
                            <div class="time">
                                <div class="notbrak">Time</div>
                                <div class="notbrak"><input type="text" value="{{$slot->starttime}}" class="timepicker timepicker-without-dropdown text-center" name="slot[{{$key+1}}][start]" size="8" value="slot[{{$key+1}}]" required /></div>
                                <div class="notbrak">To</div>
                                <div class="notbrak"><input type="text" value="{{$slot->endtime}}" class="timepicker timepicker-without-dropdown text-center" name="slot[{{$key+1}}][end]" size="8" required /></div>
                            </div>
                            <div class="date topMargin">
                                <span class="notbrak">Date</span>
                                <input type="text" value="{{Carbon\Carbon::parse($slot->date)->format('Y-m-d')}}" name="date[{{$key+1}}]" class="datepicker notbrak" size="8" required />
                            </div>
                            <div >
                                <label class="form_label notbrak" style="margin-right: 5px;">Maximum number of interviewees:</label>
                                <div class="form_input formedit_C2">
                                    {{ Form::select('salary', getMaximumInterviews(), $slot->maximumnumberofinterviewees, ['name' => 'maximumnumber['.($key+1).']', 'class' => '']) }}
                                </div>
                            </div>
                        </div>																	
                        @endforeach
                    </div>
                    <input type="hidden" name="slotsCounter" id="slotsCounter" value="{{$interview->numberofslots}}">
                    <input type="hidden" name="id" id="id" value="{{$interview->id}}">
                </div>
            </div>

            <div class="form_field">
                <span class="form_label"></span>
                <div class="form_input">
                    <div class="general_error error to_hide">&nbsp;</div>
                </div>
            </div>
             <div class="interviewSlot addSlot">
                <span class="btn small violet"> Add Interview slot</span>
            </div>

            <div class="fomr_btn act_field center">
                <button class="btn small turquoise updateNewBooking ">Update</button>
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
.leftMargin2{
    margin-left: 10%;
}
.rightMargin{
	 margin-right : 10px;
}

.topMargin{
    margin-top: 10px;
}

.textCenter{
   margin-left: 40%;
   padding-bottom: 10px !important;
}

.textCenter2{
  
			padding-bottom: 10px !important;
			font-weight: 600;
}

.dynamicTextStyle{
    margin-left: 5px;
    margin-right: 5px;
}
.interviewSlot {
    border: 2px solid #142d69;
    width: fit-content;
    padding: 10px 10px;
    color: #142d69;
    border-radius: 5px;
    opacity: 0.8;
    font-weight: 600;
    transition: all 0.5s ease;
    cursor: pointer;
}
.interviewSlot:hover{background: #142d69;color: white;}

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

// ============================================= Added new slot button start =============================================

var vals = $('.test').last().text();
var i = Number(vals)+1;
$(".addSlot").bind('click', function(){
    if(i <= 20){
        i=i;
            var slot  = '<div class="slot s'+i+' notbrak m_rb20 addNewInterviewSlot">';
                slot  += '<div class="textCenter2">Interview Slot '+i+' ';
                slot  += '<i class="fas fa-trash fl_right deleteSlot">'
                slot  += '</i>'
                slot  +=  '</div>';
                slot  += '<div class="time">';
                slot  += '<div class="notbrak dynamicTextStyle">Time</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" autocomplete="off" name="slot['+i+'][start]" size="8" required /></div>';
                slot  += '<div class="notbrak dynamicTextStyle">To</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" autocomplete="off" name="slot['+i+'][end]" size="8" required /></div>';
                slot  += '</div>';
                slot  += '<div class="date topMargin">';
                slot  += '<span class="notbrak dynamicTextStyle">Date</span>';
                slot  += '<input type="text" name="date['+i+']" class="datepicker notbrak" autocomplete="off" size="8" required />';
                slot  += '</div>';

                slot  += '<div>';
                    slot  += '<label class="form_label notbrak" style="margin-left: 5px;">Maximum number of interviewees:</label>';

                    slot  += '               <div class="form_input formedit_C2">';
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

else {
    return false;
}

// ============================================= Delete Slot JS =============================================

$('i').click(function(){
    $(this).closest('.slot').remove();
});

// ============================================= Delete Slot JS =============================================

});

// ============================================= Add new slot buttton end here =============================================

// ============================================= Delete Slot JS =============================================

$('i').click(function(){

    $(this).closest('.slot').remove();
});

// ============================================= Delete Slot JS end here =============================================

$(document).ready(function(){
    // $('input.timepicker').timepicker({});
    // $('input, select').styler();

    $('.updateNewBooking').on('click',function() {
        event.preventDefault();
        var formData = $('.new_booking_form').serializeArray();
        // $('.updateNewBooking').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
        console.log(' formData ', formData);
        $('.general_error').html('');
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/booking/update',
            data: formData,
            success: function(data){
                console.log(' data ', data);
                $('.updateNewBooking').html('Save').prop('disabled',false);
                if( data.status == 1 ){
                    // that.hideMainEditor();
                    window.location.replace(data.route);
                }else{
                    $('.general_error').html('<p>Error Creating new Booking</p>').removeClass('to_hide').addClass('to_show');
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

