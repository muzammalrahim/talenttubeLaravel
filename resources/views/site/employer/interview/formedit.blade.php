{{-- @extends('site.user.usertemplate') --}}
@extends('web.employer.employermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop
@section('content')
<div class="newJobCont profile profile-section">
   <h2 class="head icon_head_browse_matches">Interview Concierge - Editing Booking Schedule</h2>
   <div class="filter-section">
      <form method="POST" name="new_job_form" class="new_booking_form newJob job_validation">
         @csrf

         

         

         {{-- <div class="form-group row my-0">
            <label for="booking-title" class="col-sm-2 col-form-label">Booking Title</label>
            <div class="col-sm-10">
               <input type="text" value="{{$interview->title}}" name="title" id="booking-title" class="form-control bg-white" required>
               <div id="title_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div> --}}

         <div class="">
            <label for="booking-title" class="form-label font-weight-bold fs-6">Booking Title :</label>
            <input type="text" value="{{$interview->title}}" name="title" id="booking-title" class="form-control bg-white" required>
            <div id="title_error" class="error field_error to_hide">&nbsp;</div>
         </div>

         {{-- <div class="form-group row my-0">
            <label for="company" class="col-sm-2 col-form-label">Company Name</label>
            <div class="col-sm-10">
               <input type="text" value="{{$interview->companyname}}" id="company" name="companyname" class="form-control bg-white" required>
               <div id="companyname_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div> --}}


         <div class="">
            <label for="company" class="form-label font-weight-bold fs-6">Company Name :</label>
            <input type="text" value="{{$interview->companyname}}" id="company" name="companyname" class="form-control bg-white" required>
            <div id="companyname_error" class="error field_error to_hide">&nbsp;</div>
         </div>


         {{-- <div class="form-group row my-0">
            <label for="positionname" class="col-sm-2 col-form-label">Position  Name</label>
            <div class="col-sm-10">
               <input type="text" value="{{$interview->positionname}}" id="positionname" name="positionname" class="form-control bg-white" required>
               <div id="positionname_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div> --}}


         <div class="">
            <label for="positionname" class="form-label font-weight-bold fs-6">Position Name :</label>
            <input type="text" value="{{$interview->positionname}}" id="positionname" name="positionname" class="form-control bg-white" required>
            <div id="positionname_error" class="error field_error to_hide">&nbsp;</div>
         </div>

         {{-- <div class=" form-group row my-0" required>
            <label for="instruction" class="col-sm-2 col-form-label">Interview Instruction:</label>
            <div class=" col-sm-10">
               <textarea name="instruction" id="instruction" class=" form-control bg-white" maxlength="1000" style="min-height: 120px;">{{$interview->instruction}}</textarea>
               <div id="instruction_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div> --}}

         <div class="">
            <label for="instruction" class="form-label font-weight-bold fs-6">Interview Instruction :</label>
            <textarea name="instruction" id="instruction" class=" form-control bg-white" maxlength="1000" rows="3">{{$interview->instruction}}</textarea>
            <div id="instruction_error" class="error field_error to_hide">&nbsp;</div>
         </div>

         
         {{-- <div class="form-group row my-0">
            <label for="manager" class="col-sm-2 col-form-label">Additional Managers:</label>
            <div class="col-sm-10">
               <input type="text" value="{{$interview->additionalmanagers}}" id="manager" name="additionalmanagers" class="form-control bg-white" >
               <div id="additionalmanagers_error" class="error field_error to_hide">&nbsp;</div>
            </div>
         </div> --}}

         <div class="">
            <label for="manager" class="form-label font-weight-bold fs-6">Additional Managers :</label>
            <input type="text" value="{{$interview->additionalmanagers}}" id="manager" name="additionalmanagers" class="form-control bg-white" >
         </div>


         
 
         <input type="hidden" name="interviewURL" value="{{$interview->url}}">
        
         <div class="slot form_field">
            {{-- <h4 class="form_label " style="font-weight: 500;">Interview Slots:</h4> --}}
            <h2 class="head icon_head_browse_matches my-3">Interview Slots :</h2>

            <div class="form_input w100">
               <div class="slots">
                  {{-- <div class="row"> --}}
                     @php
                     $slots = $interview->slots;
                     @endphp
                     @foreach ($slots as $key => $slot)
                     <div class="slot s{{$key+1}} m_rb20 slotBorder p-2 remslot_{{ $slot->id }}">
                        <div class="font-weight-bold textCenter2 mb-2">Interview Slot <span class="test">{{$key+1}}</span> 
                           <i class="fas fa-trash text-danger fl_right deleteSlotClck pointer" data-toggle="modal" data-target = "#deleteSlotModal"></i>
                        </div>
                        <input type="hidden" class="SlotIDInputHidden" name="slotID" value="{{$slot->id}}">
                        <input type="hidden" class="companynameInSlot" id="" value="{{$interview->companyname}}">
                        <input type="hidden" class="positionnameInSlot" id="" value="{{$interview->positionname}}">
                        
                        <div class="d-inline-block mt-2">
                           <label for="time" class="d-inline-block mt-2 mr-2">Time :</label>
                           <input type="hidden" class="" name="slot[{{$key+1}}][id]" value="{{$slot->id}}" />
                           <div class="d-inline-block mt-2"> 
                              <input type="text" id="time" value="{{$slot->starttime}}" class="timepicker timepicker-without-dropdown form-control text-center pointer bg-white" name="slot[{{$key+1}}][start]" size="8" value="slot[{{$key+1}}]" required readonly />
                           </div>

                           <label for="to" class="d-inline-block mt-2 mx-2">To :</label>

                           <div class="d-inline-block mt-2">
                              <input type="text" id="to" value="{{$slot->endtime}}" class="timepicker timepicker-without-dropdown form-control text-center pointer bg-white" name="slot[{{$key+1}}][end]" size="8" required readonly />
                           </div>
    
                           <label for="date" class="d-inline-block mt-2 mx-2">Date :</label>
                           <div class="d-inline-block mt-2">
                              <input type="text" id="date" value="{{Carbon\Carbon::parse($slot->date)->format('d-m-Y')}}"   name="slot[{{$key+1}}][date]" class="datepicker form-control pointer bg-white" size="20" required readonly />
                           </div>

                           <label for="maxinterviews" class="d-inline-block mt-2 col-form-label mx-2">Maximum number of interviews:</label>
                           <div class="d-inline-block mt-2">
                              {{ Form::select('maximumnumberofinterviewees', getMaximumInterviews(), $slot->maximumnumberofinterviewees, ['name' => 'slot['.($key+1).'][maxNumberofInterviewees]', 'class' => 'selectedInput bg-white form-control icon_show', 'id'=>'maxinterviews']) }}
                           </div>
                        </div>
                        {{--  For sending email to js after updating slot --}}
                        @foreach ($slot->bookings3 as $book)
                        {{-- @dump($book->email) --}}
                        <input type="hidden" class ="useremails" name="slot[{{$key+1}}][jsEmail]" value="{{$book->email}}">
                        @endforeach
                        {{-- For sending email to js after updating slot end here --}}
                        @php
                        $bookingss = ($slot->bookings3)->toArray();
                        @endphp
                        {{-- @dump($bookingss); --}}
                        @if (!empty($bookingss))
                        <div class="slot_booking">
                           {{-- <p class="slotbooking">Slots Bookings </p> --}}
                           <p class="font-weight-bold text-dark text-center mt-2">Slots Bookings</p>

                           <div class="slot_booking_list">
                              @foreach ($slot->bookings3 as $bookings)
                              <div class="slotBookinIndex mb-2">
                                 <p class="font-weight-bold text-dark mb-1">Booking:{{ $loop->index+1 }}</p>
                                 <span class="d-inline-block"><span class="bold"> Name: </span>{{$bookings->name}}</span>
                                 <span class="d-inline-block mx-3"><span class="bold"> Email: </span>{{$bookings->email}}</span>
                                 <span class="d-inline-block"><span class="bold"> Mobile: </span>{{$bookings->mobile}}</span>
                              </div>
                              @endforeach
                              {{-- @dump($slot->bookings3) --}}
                           </div>
                        </div>
                        @else
                        <p class="slotbooking m-3">This slot is still available.</p>
                        @endif
                     </div>
                     @endforeach
                  {{-- </div> --}}
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
         <div class="d-block mb-5">
            <div class="d-inline-block w-50">
               <span class="blue_btn py-2 px-2 addSlot pointer"> Add Interview slot</span>
            </div>
            <div class="fomr_btn act_field center d-inline-block w-25">
               <button class=" updateNewBooking orange_btn px-5">Update</button>
            </div>
         </div>
      </form>
   </div>
   <div class="cl"></div>
</div>
@include('site.home.deleteSlotPop')   {{-- site/home/deleteSlotPop --}}
@stop
@section('custom_footer_css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<style>
   
</style>
@stop
@section('custom_js')
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/web/interview.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
   // $('.datepicker').datepicker({ dateFormat: "yy-mm-dd", minDate: 0, });
   
   /*jQuery('.datepicker').datepicker({
   // minDate: +1, // this will disable today date and previous date
   minDate: 0, 
   dateFormat: "yy-mm-dd", minDate: 0,
   
   
   });*/

   // ============================================= Added new slot button start =============================================
   
   var vals = $('.test').last().text();
   var i = Number(vals)+1;
   $(".addSlot").bind('click', function(){
   if(i <= 20){
   i=i;
       /*var slot  = '<div class="slot s'+i+' m_rb20 addNewInterviewSlot">';
           slot  += '<div class="textCenter2 ">Interview Slot '+i+' ';
           slot  += '<i class="fas fa-trash text-danger fl_right deleteSlot">'
           slot  += '</i>'
           slot  +=  '</div>';
           slot  += '<div class="time notbrak">';
           slot  += '<div class="notbrak dynamicTextStyle fw-bold">Time:</div>';
           slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center pointer bg-white" autocomplete="off" readonly name="slot['+i+'][start1]" size="8" required /></div>';
           slot  += '<div class="notbrak dynamicTextStyle">To</div>';
           slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center pointer bg-white" autocomplete="off" readonly name="slot['+i+'][end1]" size="8" required /></div>';
           slot  += '</div>';
           slot  += '<div class="date topMargin notbrak">';
           slot  += '<span class="notbrak dynamicTextStyle fw-bold pl-4">Date:</span>';
           slot  += '<input type="text" name="slot['+i+'][date1]" class="datepicker notbrak pointer bg-white" autocomplete="off" readonly size="20" required />';
           slot  += '</div>';
   
           slot  += '<div class="notbrak" style="vertical-align:bottom;">';
               
   
               slot  += '               <div class="form_input  selectInput " style="display:contents;margin-bottom:0!important;">';
               slot  += '<label class="form_label notbrak fw-bold ps-5" style="margin-left: 5px; padding-top:0px!important; padding-bottom:0px!important;">Maximum number of interviews:</label>';
                   slot  += '                  <select name="slot['+i+'][maxNumberofInterviewees1]" class="form_select bg-white" >';
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
                       slot  += '  </div>';*/

         var   slot  = '<div class="slot s'+i+' m_rb20 slotBorder p-2 addNewInterviewSlot">';
               slot  += '<div class="font-weight-bold textCenter2 mb-2">Interview Slot '+i+' ';
               slot  += '<i class="fas fa-trash text-danger fl_right deleteSlot">'
               slot  += '</i>'
               slot  +=  '</div>';

               slot += '<div class="d-inline-block mt-2">';

               slot +=    '<label for="time" class="d-inline-block mt-2 mr-2">Time :</label>';
               // slot +=       '<input type="hidden" class="" name="slot['+i+'][id]">';
               slot +=        '<div class="d-inline-block mt-2"> ';
               slot +=           '<input type="text" name="slot['+i+'][start1]" id="time" class="timepicker timepicker-without-dropdown form-control text-center pointer bg-white"  size="8" required="" readonly="">';
               slot +=         '</div>';

               slot +=         '<label for="to" class="d-inline-block mt-2 mx-2">To :</label>';

               slot +=         '<div class="d-inline-block mt-2">';
               slot +=            '<input type="text" name="slot['+i+'][end1]" id="to" class="timepicker timepicker-without-dropdown form-control text-center pointer bg-white" size="8" required="" readonly="">';
               slot +=         '</div>';
 
                        
               slot +=         '<label for="date" class="d-inline-block mt-2 mx-2">Date :</label>';
               slot +=         '<div class="d-inline-block mt-2">';
               slot +=            '<input type="text" name="slot['+i+'][date1]" class="datepicker form-control pointer bg-white" autocomplete="off" readonly size="20" required />';
               slot +=         '</div>';
                     
                     
               slot +=         '<label for="maxinterviews" class="d-inline-block mt-2 col-form-label mx-2">Maximum number of interviews:</label>';

                        
                           
               slot +=         '<div class="d-inline-block mt-2">';
               slot +=            '<select name="slot['+i+'][maxNumberofInterviewees1]" class="selectedInput bg-white form-control icon_show" id="maxinterviews">';
               slot +=              '<option value="1" selected="selected">1</option>';
               slot +=              '<option value="2">2</option>';
               slot +=              '<option value="3">3</option>';
               slot +=              '<option value="4">4</option>';
               slot +=              '<option value="5">5</option>';
               slot +=              '<option value="6">6</option>';
               slot +=              '<option value="7">7</option>';
               slot +=              '<option value="8">8</option>';
               slot +=              '<option value="9">9</option>';
               slot +=              '<option value="10">10</option>';
               slot +=              '<option value="12">12</option>';
               slot +=              '<option value="13">13</option>';
               slot +=              '<option value="14">14</option>';
               slot +=              '<option value="15">15</option>';
               slot +=              '<option value="16">16</option>';
               slot +=              '<option value="17">17</option>';
               slot +=              '<option value="18">18</option>';
               slot +=              '<option value="19">19</option>';
               slot +=              '<option value="20">20</option>';
               slot +=              '</select>';
               slot +=         '</div>';
                        
               slot +=      '</div>';




           // slot  += '</div>';
           slot  += '<div class="checkStatusError hide_it2"> <span>Fill all fields before proceeding to next slot</span> </div>';
   
   $('.slots').append(slot);
   $(".datepicker").datepicker({ dateFormat: "dd-mm-yy", minDate: 0, });
   $('input.timepicker').timepicker({
        scrollbar: true
   });
   $('#slotsCounter').val(this.value);
   // $('input, select').styler();
   i++;
   
   }
   
   else {
   return false;
   }

   // ============================================= Delete Slot JS =============================================
   
   
   $('.deleteSlot').click(function(){
   $(this).closest('.slot').remove();
   });
   
   
   // ============================================= Delete Slot JS =============================================
   
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
   
   // ================================= Delete Slot Popup Open onClick =================================
   
   if( $('#deleteSlotModal').length ){
   // var $deleteSlot = $('#deleteSlotModal').modalPopup({shClass: ''});
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
   }
   
   $('#deleteSlot_confirm').click(function(){
   
   var slotID = $('.slotIDPopUp').val();
   var companyName = $('.comnameInPopUp').val();
   var usEmail = $('.useremailInPopup').val();
   var positionamae = $('.posNamePopup').val();
   // console.log(companyName);
   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
       $.ajax({
       type: 'POST',
       url: base_url+'/ajax/booking/deleteSlot',
       data:{id: slotID,company:companyName,useremail:usEmail,position:positionamae},
       success: function(data){
           console.log(' data ', data);
   
           if( data.status == 1 ){
            
            $('.remslot_'+slotID+'').remove();
           $('#deleteSlotModal').close();
   
               location.reload();
   
           }else{
              
           }
   
       }
   });
   
   });
   
   // ================================= Delete Slot Pop up close onClick =================================
   
   $('.close_hover').click(function() {
   $('#deleteSlotModal').close();
   
   });
   
   // ================================= Delete Slot Popup Open onClick =================================
   
</script>
@stop