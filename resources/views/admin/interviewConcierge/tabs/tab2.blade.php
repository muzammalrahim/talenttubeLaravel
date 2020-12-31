<div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

	<div class="slot form_field">
	   <label class="form_label">Interview Slots:</label>
	   <div class="form_input w100">
	      <div class="slots">
	         @php
	         $slots = $record->slots;
	         @endphp
	         @foreach ($slots as $key => $slot)
	         <div class="slot s{{$key+1}} m_rb20">
	            <div class="textCenter2 font-20 font-weight-bold">Interview Slot <span class="test">{{$key+1}}</span> 
	               <i class="fas fa-trash deleteSlotClck pointer float-right" data-toggle="modal" data-target="#deleteSlotPopUp"></i>
	            </div>
	            <input type="hidden" class="SlotIDInputHidden" name="slotID" value="{{$slot->id}}">
	            <input type="hidden" class="companynameInSlot" id="" value="{{$record->companyname}}">
	            <input type="hidden" class="positionnameInSlot" id="" value="{{$record->positionname}}">
	            <div class="time notbrak">
	               <div class="notbrak">Time</div>
	               <input type="hidden" name="slot[{{$key+1}}][id]" value="{{$slot->id}}" />
	               <div class="notbrak"><input type="text" value="{{$slot->starttime}}" class="timepicker timepicker-without-dropdown text-center pointer" readonly="true"  name="slot[{{$key+1}}][start]" size="8" value="slot[{{$key+1}}]" required /></div>
	               <div class="notbrak">To</div>
	               <div class="notbrak"><input type="text" value="{{$slot->endtime}}" class="timepicker timepicker-without-dropdown text-center pointer" readonly="true"  name="slot[{{$key+1}}][end]" size="8" required /></div>
	            </div>
	            <div class="date topMargin notbrak">
	               <span class="notbrak">Date</span>
	               <input type="text" value="{{Carbon\Carbon::parse($slot->date)->format('Y-m-d')}}"   name="slot[{{$key+1}}][date]" class="datepicker notbrak pointer" readonly="true" size="8" required />
	            </div>
	            <div class="notbrak">
	               <span class="form_label notbrak float_none notbrak" style="margin-right: 5px;vertical-align: middle;">Maximum number of interviewees:</span>
	               <div class="form_input formedit_C2 notbrak">
	                  {{ Form::select('maximumnumberofinterviewees', getMaximumInterviews(), $slot->maximumnumberofinterviewees, ['name' => 'slot['.($key+1).'][maxNumberofInterviewees]', 'class' => 'selectedInput custom-select']) }}
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
	               <p class="slotbooking">Slots Bookings </p>
	               <div class="slot_booking_list">
	                  @foreach ($slot->bookings3 as $bookings)
	                  <div class="slotBookinIndex d-flex">
	                     <h3 class="font-20 font-weight-bold">Booking:{{ $loop->index+1 }}</h3>
	                     <p class="mx-3"><span class="font-weight-bold"> Name: </span>{{$bookings->name}}</p>
	                     <p class="mx-3"><span class="font-weight-bold"> Email: </span>{{$bookings->email}}</p>
	                     <p class="mx-3"><span class="font-weight-bold"> Mobile: </span>{{$bookings->mobile}}</p>
	                  </div>
	                  @endforeach
	                  {{-- @dump($slot->bookings3) --}}
	               </div>
	            </div>
	            @else
	            <p class="slotbooking">This slot has not any booking.</p>
	            @endif
	         </div>
	         @endforeach
	      </div>
	      {{-- <input type="hidden" name="slotsCounter" id="slotsCounter" value="{{$record->numberofslots}}"> --}}
	      <input type="hidden" name="interview_id" id="" value="{{$record->id}}">
	      <input type="hidden" name="positionnameInSlot" id="" value="{{$record->positionname}}">
	      <input type="hidden" name="companynameInSlot" id="" value="{{$record->companyname}}">
	    </div>
	</div>

	<div class="form_field">
        <span class="form_label"></span>
        <div class="form_input">
            <div class="general_error error to_hide">&nbsp;</div>
        </div>
    </div>
    
    <div class="addSlot text-center">
        <span class="btn btn-success small violet"> Add Interview slot</span>
    </div>

 {{--    <div class="fomr_btn act_field center">
        <button class="btn btn-primary small turquoise updateNewBooking ">Update</button>
    </div> --}}

    <a class="btn btn-primary btnPrevious text-white mt-3"onclick="scrollToTop()" >Previous</a>
    {{-- <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a> --}}

</div>

