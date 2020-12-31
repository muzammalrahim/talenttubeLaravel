{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')


@section('content')

<div class="card .border-info mb-3 bg-white rounded newJobCont">
   <div class="card-header reponsive_header jobAppHeader icon_head_browse_matches head_concierge_botmline">Interview Concierge - Editing Booking Schedule</div>
   <div style="background: #dddfe3;" class="card-body add_new_job">
      <form method="POST" name="new_job_form" class="new_booking_form newJob job_validation">
            @csrf
            <div class="job_title form_field">
                <span class="form_label">Booking Title :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->title}}" name="title" class="form-control" required>
                    <div id="title_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Company Name :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->companyname}}" name="companyname" class="form-control" required>
                    <div id="companyname_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Position Name :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->positionname}}" name="positionname" class="form-control" required>
                    <div id="positionname_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            {{-- <div class="job_title form_field">
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
            </div> --}}

            <div class="job_description form_field" required>
                <span class="form_label">Interview Instruction: </span>
                <div class="form_input">
                    <textarea name="instruction" class="form-control rounded-0" maxlength="1000" style="min-height: 120px;">{{$interview->instruction}}</textarea>
                    <div id="instruction_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>



            <div class="job_title form_field">
                <span class="form_label">Additional Managers :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->additionalmanagers}}" name="additionalmanagers" class="form-control" >
                    <div id="additionalmanagers_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>

            {{-- <div class="job_title form_field">
                <span class="form_label">Booking ID :</span>
                <div class="form_input">
                    <input type="text" value="{{$interview->uniquedigits}}" name="uniquedigits" class="w100" >
                    <div id="additionalmanagers_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div> --}}

            <input type="hidden" name="interviewURL" value="{{$interview->url}}">
            {{-- <input type="hidden" name="interviewID" value="{{$interview->id}}"> --}}


         {{--    <div class="job_title form_field">
                <span class="form_label">Number of Slots :</span>
                <div class="form_input">
                    <input type="number" class="jq-number__field" value="{{$interview->numberofslots}}" name="numberofslots" min="1" max="20" class="w20" >

                    <div id="title_error" class="error field_error to_hide">&nbsp;</div>
                    
                </div>
            </div> --}}


            <div class="slot form_field">
                <label class="form_label">Interview Slots:</label>
                <div class="form_input w100">
                    <div class="slots">
                        @php
                        $slots = $interview->slots;
                        @endphp
                        @foreach ($slots as $key => $slot)
                        

                        <div class="slot s{{$key+1}} m_rb20 border border-dark p-2 mb-2">
                            <div class="textCenter2">Interview Slot <span class="test">{{$key+1}}</span> 
                                <i class="fas fa-trash fl_right deleteSlotClck pointer" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black"></i>
                            </div>

                            <input type="hidden" class="SlotIDInputHidden" name="slotID" value="{{$slot->id}}">
                            {{-- <input type="hidden" class="SlotIDInputHidden" name="slotID" value="{{$slot->id}}"> --}}
                            <input type="hidden" class="companynameInSlot" id="" value="{{$interview->companyname}}">
                            <input type="hidden" class="positionnameInSlot" id="" value="{{$interview->positionname}}">

                            <div class="time notbrak">
                                <div class="notbrak">Time</div>
                                
                                <input type="hidden" name="slot[{{$key+1}}][id]" value="{{$slot->id}}" />

                                <div class="notbrak">
                                  <input type="text" value="{{$slot->starttime}}" class="timepicker timepicker-without-dropdown text-center form-control" name="slot[{{$key+1}}][start]" size="8" value="slot[{{$key+1}}]" required />
                                </div>
                                <div class="notbrak">To</div>

                                <div class="notbrak">
                                  <input type="text" value="{{$slot->endtime}}" class="timepicker timepicker-without-dropdown text-center form-control" name="slot[{{$key+1}}][end]" size="8" required />
                                </div>
                            </div>

                            <div class="notbrak">
                                <div class="notbrak">Date</div>
                                <input type="date" value="{{Carbon\Carbon::parse($slot->date)->format('Y-m-d')}}"   name="slot[{{$key+1}}][date]" class=" form-control" size="8" required />
                            </div> 

                            <div class="row">
                                <label class="form_label notbrak col-7">Maximum number of interviewees:</label>
                                <div class="form_input formedit_C2 col-5">
                                    {{ Form::select('maximumnumberofinterviewees', getMaximumInterviews(), $slot->maximumnumberofinterviewees, ['name' => 'slot['.($key+1).'][maxNumberofInterviewees]', 'class' => 'form-control']) }}
                                </div>
                            </div>

                             @foreach ($slot->bookings3 as $book)
                                    <input type="hidden" class ="useremails" name="slot[{{$key+1}}][jsEmail]" value="{{$book->email}}">
                            @endforeach

                            @php
                                $bookingss = ($slot->bookings3)->toArray();
                            @endphp
                            
                            @if (!empty($bookingss))
                            
                                <div class="slot_booking mt-3">
                                    <p class="slotbooking text-center font-weight-bold">Slots Bookings </p>
                                        <div class="slot_booking_list">
                                            @foreach ($slot->bookings3 as $bookings)
                                                <div class="slotBookinIndex">
                                                    <h6 class="font-weight-bold">Booking:{{ $loop->index+1 }}</h6> 
                                                    <p class="m-0"><span> Name: </span>{{$bookings->name}}</p>
                                                    <p class="m-0"><span> Email: </span>{{$bookings->email}}</p>
                                                    <p class="m-0"><span> Mobile: </span>{{$bookings->mobile}}</p>
                                                </div>
                                            @endforeach
                                            {{-- @dump($slot->bookings3) --}}
                                        </div>
                                </div>
                            @else
                                <p class="slotbooking text-center font-weight-bold">This slot is still available.</p>

                            @endif

                        </div>  

                        @endforeach
                    </div>
                    {{-- <input type="hidden" name="slotsCounter" id="slotsCounter" value="{{$interview->numberofslots}}"> --}}
                    <input type="hidden" name="interview_id" id="" value="{{$interview->id}}">
                    <input type="hidden" name="positionnameInSlot" id="" value="{{$interview->positionname}}">
                    <input type="hidden" name="companynameInSlot" id="" value="{{$interview->companyname}}">

                </div>
            </div>

            <div class="form_field">
                <span class="form_label"></span>
                <div class="form_input">
                    <div class="general_error error to_hide">&nbsp;</div>
                </div>
            </div>
             <div class="interviewSlot addSlot">
                <span class="btn btn-sm btn-primary"> Add Interview slot</span>
            </div>

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
	

.textCen{
	text-align:center;
}

.slotRowMargin{
	 margin-left:0;
		margin-right:0;
}

.slotFontSize {
    font-size: 14px;
}

.notbrak{
    display:block;
}
.textCenter2{
    padding-bottom: 10px !important;
    font-weight: 600;
}

.sc{ 
	
height: auto;
max-height: 60px;
position: relative;
list-style: none;
overflow: hidden auto!important;;
}

.w_100{
    width:100%
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




// ============================================= Added new slot button start =============================================

var vals = $('.test').last().text();
var i = Number(vals)+1;
$(".addSlot").bind('click', function(){
    if(i <= 20){
        i=i;
            var slot  = '<div class="slot s'+i+' notbrak m_rb20 addNewInterviewSlot border border-dark p-2 mb-1">';
                slot  += '<div class="textCenter2">Interview Slot '+i+' ';
                slot  += '<i class="fas fa-trash fl_right deleteSlot">'
                slot  += '</i>'
                slot  +=  '</div>';
                slot  += '<div class="time">';
                slot  += '<div class="notbrak dynamicTextStyle">Time</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center form-control" autocomplete="off" name="slot['+i+'][start1]" size="8" required /></div>';
                slot  += '<div class="notbrak dynamicTextStyle">To</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center form-control" autocomplete="off" name="slot['+i+'][end1]" size="8" required /></div>';
                slot  += '</div>';
                slot  += '<div class="date topMargin">';
                slot  += '<span class="notbrak dynamicTextStyle">Date</span>';
                slot  += '<input type="date" name="slot['+i+'][date1]" class="notbrak form-control" autocomplete="off" size="8" required />';
                slot  += '</div>';

                slot  += '<div class="row">';
                    slot  += '<label class="form_label notbrak col-7">Maximum number of interviewees:</label>';

                    slot  += '               <div class="form_input formedit_C2 col-5">';
                        slot  += '                  <select name="slot['+i+'][maxNumberofInterviewees1]" class="form-control" >';
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

$('.slots').on('click','.deleteSlot', function(){

    $(this).closest('.slot').remove();
});


// ============================================= Delete Slot JS end here =============================================

$(document).ready(function(){
   $('input.timepicker').timepicker({});
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
// ========================================for Add date =============================================

// ================================= Delete Slot Pop =====================================


$('.deleteSlotClck').click(function(){
        console.log(' open ');
        // $deleteSlot.open();
        var deleteSlot2 = $(this).closest('.slot').find('.SlotIDInputHidden').val();
        var companyName = $(this).closest('.slot').find('.companynameInSlot').val();
        var useremail = $(this).closest('.slot').find('.useremails').val();
        var psnameinSlot = $(this).closest('.slot').find('.positionnameInSlot').val();
        console.log(psnameinSlot);
        var slotIDPopup = $('.slotIDPopUp').val(deleteSlot2);
        var comnamePopUp = $('.comnameInPopUp').val(companyName);
        var uEmail = $('.useremailInPopup').val(useremail);
        var psname = $('.posNamePopup').val(psnameinSlot);
        console.log(uEmail);return;

        return false;
    });



    $('#deleteSlot_confirm').click(function(){

        var slotID = $('.slotIDPopUp').val();
        var companyName = $('.comnameInPopUp').val();
        var usEmail = $('.useremailInPopup').val();
        var positionamae = $('.posNamePopup').val();
        // console.log(companyName);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/booking/MdeleteSlot',
            data:{id: slotID,company:companyName,useremail:usEmail,position:positionamae},
            success: function(data){
                console.log(' data ', data);

                if( data.status == 1 ){

                    location.reload();
                    // $('.successMsgDeleteBooking').removeClass('d-none');
                    // setTimeout(function() {
                    //    // $('.successMsgDeleteBooking') .addClass('d-none');
                    //    location.reload();
                    // }, 3000);

                }else{
                   
                }

            }
        });

    });

// ================================= Delete Slot Pop up end here

$('input.datepicker').datepicker({
// Escape any “rule” characters with an exclamation mark (!).
format: 'You selecte!d: dddd, dd mmm, yyyy',
formatSubmit: 'yyyy/mm/dd',
hiddenPrefix: 'prefix__',
hiddenSuffix: '__suffix'
})


</script>
@stop

