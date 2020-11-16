{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')


@section('content')
<div class="newJobCont card border-info mb-3 shadow mb-3 bg-white rounded">
    <div class="card-header jobAppHeader reponsive_header icon_head_browse_matches head_concierge_botmline pb-3 pt-3 ">Interview Concierge - Creating New Booking Schedule</div>
    <div class="card-body jobAppBody add_new_job  ">

        <form method="POST" name="new_job_form" class="new_booking_form newJob job_validation">
            @csrf
												
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label ">Booking Title :</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" value="" required >
                      <div id="title_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>

             <div class="form-group row">
                    <label class="col-sm-2 col-form-label ">Company Name :</label>
                    <div class="col-sm-10">
                    <input type="text" name="companyname" class="form-control" value=""  required>
                      <div id="companyname_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>


               <div class="form-group row">
                    <label class="col-sm-2 col-form-label ">Position Name :</label>
                    <div class="col-sm-10">
                    <input type="text" value=""  name="positionname" class="form-control" required>
                      <div id="positionname_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>


           <div class="form-group row">
                    <label class="col-sm-2 col-form-label ">Employer Email :</label>
                    <div class="col-sm-10">
                  <input type="email"  class="form-control"  value="" name="employeremail" required>
                      <div id="employeremail_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>


    												<div class="form-group row">
                    <label class="col-sm-2 col-form-label ">Booking Password :</label>
                    <div class="col-sm-10">
                  <input type="text"  class="form-control"  value="" name="employerpassword" required>
                      <div id="employerpassword_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>
        
															<div class="form-group row">
                    <label class="col-sm-2 col-form-label ">Interview Instruction:</label>
                    <div class="col-sm-10">
                  <textarea class="form_editor"  value="" name="instruction"  maxlength="1000" style="min-height: 120px; width:100%"></textarea>
                      <div id="instruction_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>

        

           
															<div class="form-group row">
                    <label class="col-sm-2 col-form-label ">Additional Managers :</label>
                    <div class="col-sm-10">
                  <input type="text"  class="form-control"  value="" name="additionalmanagers" required>
                      <div id="additionalmanagers_error" class="error field_error to_hide">&nbsp;</div>
                    </div>
                </div>



            <h5 class="interSlotHeading">Interview Slots</h5>
 
            <div class="slot form_field">
                <div class="form_input w100">
                    <div class="slots ">
                        <div class="slot s1 notbrak  topMargin borderline">

                            <div class="mb10 font-weight-bold">Interview Slot 1 <span class="fl_right"> <i class="fas fa-trash deleteSlot fl_right tk"></i></span></div>
                            <div class="time mt-2">



		<div class="row  slotRowMargin">
												<div class="col-2 slotColPadding slotFontSize mt-1 textCen">
												
																	<p>
           									Time
       													 </p>
													</div>
  										<div  class="col-4  slotColPadding"><input type="text" class="form-control form-control-sm timepicker timepicker-without-dropdown " autocomplete="off" name="slot[1][start]" twelvehour="true"  required /></div>
 											 <div  class="col-2 slotColPadding mt-1 slotFontSize textCen"> 
																		<p>
          											 To
       								 </p>
														</div>
													<div  class="col-4 slotColPadding"><input type="text" class="form-control form-control-sm timepicker timepicker-without-dropdown  " autocomplete="off" name="slot[1][end]" twelvehour="true" required />
    					  </div>
											</div>

                            
                            <div class="date mt-3 topMargin w100 d-flex">
                                <span class="notbrak mr-1">Date</span>
                                <input  type="date"  name="date[1]" style="margin-left:2px"  class=" form-control form-control-sm  notbrak checkstatusDate"  autocomplete="off"  required />
																										</div>																			
                              <div class="mt-3 m_no_i ">
                                <label class="w80 notbrak my10" style="margin-right: 5px;">Maximum number of interviewees:</label>
                                <div style="" class="form_input">
                                    <select name="maximumnumber[1]" class="browser-default form_select" >
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
                <button class="btn btn-primary btn-sm addSlot"> Add Interview slot</button>
            </div>

            <div class="fomr_btn act_field center text-center">
                {{-- <span class="form_label"></span> --}}
                {{-- <input type="type" value="academic" /> --}}
                <button class="btn mt-4 btn-cyan btn-sm  saveNewBooking" >Save</button>
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

.reponsive_header{
		
    font-size: 3vw;
    text-align: center;
   
    font-weight: 700;
}
.textCen {
    text-align: center;
}

	.slotRowMargin{
		 margin-left:0;
			margin-right:0;
	}
.slotColPadding{
	  padding-right:0;
			padding-left:0;
}
.notbrak{
    display: inline-block;
}

.leftMargin{
    margin-left: 10px;
}
.leftMargin2{
    margin-left: 3%;
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

<script src="{{ asset('js/site/jquery-ui.js') }}"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
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
//             slot  += '</div>
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
    var timeEndValue = $('.checkstatus1').val();
    var timeDateValue = $('.checkstatusDate').val();
    var checkstatusjq = $('.checkstatusjq').last().val();
    var array = [timeValue,timeEndValue,timeDateValue];
    console.log(array);

if($.inArray(checkstatusjq, array)){
    if(($('.ui-timepicker-viewport li a').text()) == timeValue ){
        $(this).css('display', 'block');
  
    }
}
    // if(timeValue != "" && timeEndValue != "" && timeDateValue != "")
    // {

    if(i <= 20){
        i=i;
            var slot  = '<div class="slot s'+i+' notbrak m_rb20 borderline">';
             slot  += '<div class="mb10  dynamicTextStyle font-weight-bold">Interview Slot '+i+' ';
               slot  += '<i id ="deleteSlot" class="fas fa-trash deleteSlot'+i+' fl_right">';
                slot  += '</i>';  
																                                 
																slot  += '</div>';		
																slot  += '<div class="time mt-2">';
																
																slot  += '<div style="display:flex;" class="form-group  w-100">';
																slot  += '	<p class="mr-1">		 Time </p>';
																slot  += '<div class="notbrak"><input type="text" class="form-control form-control-sm timepicker timepicker-without-dropdown  checkstatusjq" autocomplete="off" name="slot['+i+'][start]"  required /></div>';
																
																slot  += '	<p style="margin:5px">		 To </p>';
																
																slot  += '<div class="notbrak"><input type="text" class="form-control form-control-sm timepicker timepicker-without-dropdown " autocomplete="off" name="slot['+i+'][end]"  required /></div>';
																slot  += '</div>';
																slot  += '</div>';
																
                slot  += '<div class="date topMargin mt-3 w100 d-flex">';
                slot  += '<span class="notbrak mr-1">Date</span>';
                slot  += '<input type="date" name="date['+i+']" class="form-control form-control-sm  notbrak checkstatusDate" autocomplete="off" size="33" required />';
                slot  += '</div>';
                slot  += '<div class="m_no_i mt-3">';
                    slot  += '<label class="w80 notbrak my10" style="margin-left: 5px;">Maximum number of interviewees:</label>';
                    slot  += ' <div class="form_input ">';
                        slot  += ' <select name="maximumnumber['+i+']" style="" class="form_select browser-default" >';
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

// }

// else{

//     timeValue = '';
//     $( ".checkStatusError" ).show().delay(4000).fadeOut('slow');
//     console.log(timeValue);
// }

$('i').click(function(){
    $(this).closest('.slot').remove();
});



});

// ============================================= Add new buttton end here =============================================



// ============================================= Deleting Slot FUnction =============================================

$('.deleteSlot').click(function(){


    $(this).closest('.slot').remove();

//    // var parentSlot =  $('.slot').parent();
//    // var childSlot = parentSlot.children();
//    // $(childSlot).remove();
//    // var childSlot =  parentSlot.children();
//    // $(this).remove(childSlot);
//    // console.log(childSlot);
});



 




// ============================================= Deleting Slot FUnction end here =============================================

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
// ========================================for Add date =============================================

$('.datepicker').datepicker({
// Escape any “rule” characters with an exclamation mark (!).
format: 'You selecte!d: dddd, dd mmm, yyyy',
formatSubmit: 'yyyy/mm/dd',
hiddenPrefix: 'prefix__',
hiddenSuffix: '__suffix'
})




</script>
@stop

