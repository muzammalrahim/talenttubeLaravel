{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

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
                        <div class="slot s{{$key+1}} notbrak leftMargin topMargin rightMargin">
                            <div class="textCenter2">Interview Slot {{$key+1}} <span class="deleteSlot fl_right tk"> <i class="fas fa-trash"></i></span></div>
                            <div class="time">
                                <div class="notbrak">Time</div>
                                <div class="notbrak"><input type="text" value="{{$slot->starttime}}" class="timepicker timepicker-without-dropdown text-center" name="slot[{{$key+1}}][start]" size="8" required /></div>
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


            <div class="fomr_btn act_field leftMargin2" style="margin-left:10%">
                <span class="form_label"></span>
                {{-- <input type="type" value="academic" /> --}}
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
	 margin-right : 4%;
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

$("input[type=number]").bind('keyup input', function(){
   // alert("fired");
   console.log("This value",this.value);
    if(this.value>20 || this.value <1){
        this.value =1;
        return 0;
    }

    var sC = parseInt($('#slotsCounter').val());


    console.log("Slot counter",sC);


    if(sC<this.value){
    for (i=sC+1; i<=this.value; i++){
        var slot  = '<div class="slot s'+i+' notbrak leftMargin topMargin">';
            slot  += '<div class="textCenter2">Interview Slot '+i+'</div>';
            slot  += '<div class="time">';
            slot  += '<div class="notbrak dynamicTextStyle">Time</div>';
            slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" name="slot['+i+'][start]" size="8" required /></div>';
            slot  += '<div class="notbrak dynamicTextStyle">To</div>';
            slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" name="slot['+i+'][end]" size="8" required /></div>';
            slot  += '</div>';
            slot  += '<div class="date topMargin">';
            slot  += '<span class="notbrak dynamicTextStyle">Date</span>';
            slot  += '<input type="text" name="date['+i+']" class="datepicker notbrak" size="8" required />';
            slot  += '</div>';

            slot  += '<div>';
                slot  += '<label class="form_label notbrak" style="margin-right: 5px;">Maximum number of interviewees:</label>';

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
            $('.slots').append(slot);
    }
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
    $('input.timepicker').timepicker({});
    $('#slotsCounter').val(this.value);
    $('input, select').styler();
    }

    else if(sC > this.value){

        for (i=sC; i>this.value; i--){

            $( ".s"+i ).remove();

        }

    $('#slotsCounter').val(this.value);
    }



});

$(document).ready(function(){
    $('input.timepicker').timepicker({});
    $('input, select').styler();




$('.updateNewBooking').on('click',function() {

    event.preventDefault();
    var formData = $('.new_booking_form').serializeArray();
    $('.updateNewBooking').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
    console.log(' formData ', formData);
    $('.general_error').html('');
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/booking/update',
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

