    
@extends('mobile.user.unRegUser')

@section('content')

<div class="card">
	{{-- <div class="header1 card-header text-center"> --}}
		<h6 class="card-header h6">Interview Concierge - Booking on Mobile {{$interview->uniquedigits}} </h6>
	{{-- </div>  --}}

	{{-- @dump($interview->slots); --}}
	<div class="firstLayout card-body p-2">
		<div class="form-group row mt-4">
	        {{ Form::label('Booking Title', null, ['class' => 'col-md-2 form-control-label']) }}
	        <div class="col-md-10">
	          {{ Form::text('Title', $value = $interview->title , $attributes = array('class'=>'form-control', 'readonly' =>'true')) }}
	        </div>
	    </div>

	    <div class="form-group row mt-4">
	        {{ Form::label('Company Name', null, ['class' => 'col-md-2 form-control-label']) }}
	        <div class="col-md-10">
	          {{ Form::text('Company Name', $value = $interview->companyname , $attributes = array('class'=>'form-control','readonly' =>'true')) }}
	        </div>
	    </div>

	    <div class="form-group row mt-4">
	        {{ Form::label('Position Name', null, ['class' => 'col-md-2 form-control-label']) }}
	        <div class="col-md-10">
	          {{ Form::text('Position Name', $value = $interview->positionname , $attributes = array('class'=>'form-control','readonly' =>'true')) }}
	        </div>
	    </div>

	    <div class="form-group row mt-4">
	        {{ Form::label('Instruction', null, ['class' => 'col-md-2 form-control-label']) }}
	        <div class="col-md-10">
	          {{ Form::text('Instruction', $value = $interview->instruction , $attributes = array('class'=>'form-control', 'readonly' =>'true')) }}
	        </div>
	    </div>

	    <p class="text-center moreDetails"> Please select from the below available time/date for your interview.If you have already selected an <br>
	    	interview time and wish to cancel or reschedule, please click 
	    	<span class="clickHere interviewConciergeRoute" > here  </span> 
	    </p>


	    <div class="slots">
	        @php
	        $slots = $interview->slots;
	        @endphp
	        @foreach ($slots as $key => $slot)
	        	{{-- @dump($slot->id); --}}
	        	

	        <div class="slot s{{$key+1}} notbrak m_rb20 mr-4">
	        	<input type="hidden" name="" value="{{$slot->id}}" class="slotIDinInputTypeInSlot">

	            <div class="font-weight-bold">Interview Slot <span class="test">{{$key+1}}</span> 
	            </div>
	            <div class="time">
	                <div class="notbrak">Time</div>

	                <div class="notbrak mx-2"><input type="text" value="{{$slot->starttime}}" class="timepicker timepicker-without-dropdown text-center" name="slot[{{$key+1}}][start]" size="8" readonly="true" value="slot[{{$key+1}}]" required />
	                </div>

	                <div class="notbrak">To</div>

	                <div class="notbrak mx-2"><input type="text" value="{{$slot->endtime}}" class="timepicker timepicker1 timepicker-without-dropdown text-center" name="slot[{{$key+1}}][end]" size="8" readonly="true" required />
	                </div>
	            </div>

	            <div class="date topMargin">
	                <span class="notbrak">Date</span>
	                <input type="text" value="{{Carbon\Carbon::parse($slot->date)->format('Y-m-d')}}" readonly="true" name="date[{{$key+1}}]" class="datepicker notbrak mx-1 mt-2" size="8" required />
	            </div>
	            <div class="text-center mt-3">
	                <button onclick="topFunction()" class="btn-sm btn btn-primary selectTimeUrl"> Select This Time</button>
	            </div>
	          
	        </div>																	
	        @endforeach
	    </div>
    </div>
	 
	<div class="p-1">  	
	    <form method="POST" name="new_interview_form" class="new_slot_form newJob job_validation">
	    	@csrf

		    <div class="selectedTimeSlot d-none my-4">

		    	<input type="hidden" name="interviewId" value="{{$interview->id}}" class="interviewIDinInputType">
        		<input type="hidden" name="slotId" value="" class="slotIDinInputType">
	        	<input type="hidden" name="employerEmail" value="{{$interview->employerData->email}}">	
	        	<input type="hidden" name="manager" value="{{$interview->additionalmanagers}}">
	        	<input type="hidden" name="position" value="{{$interview->positionname}}">

		    	<div class="">
			    	<div class="slot notbrak">
			            <div class="font-weight-bold my-3"><span class="test"> Thank you for selecting the below interview time.</span> 
			            </div>
			            <div class="time">
			                <div class="notbrak">Time</div>

			                <div class="notbrak mx-2"><input type="text" value="" name="timepicker" class="timepicker selectedTImePicker timepicker-without-dropdown text-center" readonly="true" size="8" value="" required />
			                </div>

			                <div class="notbrak">To</div>

			                <div class="notbrak mx-2"><input type="text" value="" name="timepicker1" class="timepicker selectedTimePicker1 timepicker-without-dropdown text-center" readonly="true" size="8" required />
			                </div>
			            </div>

			            <div class="date topMargin">
			                <span class="notbrak">Date</span>
			                <input type="text" value="" name="datepicker" class="selectedDatePicker notbrak mx-1 mt-2" readonly="true" size="8" required />
			            </div>

			        </div>

			        <div class="slot notbrak">
			            <div class="font-weight-bold my-3"><span class="test"> To confirm your booking, please complete the foollowing details.</span> 
			            </div>


			            <div class="form-group row mt-4">
					        {{ Form::label('Name', null, ['class' => 'col-md-2 form-control-label']) }}
					        <div class="col-md-10">
					          {{ Form::text('name', $value =  null, $attributes = array('class'=>'form-control nameErrorClass', 'required' =>'true')) }}
					        </div>
					    </div>
				   
			    		<p class="errorInName p-0 m-0 text-danger hide"></p>	

					    <div class="form-group row mt-4">
					        {{ Form::label('Mobile', null, ['class' => 'col-md-2 form-control-label']) }}
					        <div class="col-md-10">
					          {{ Form::text('mobile', $value =  null, $attributes = array('class'=>'form-control mobileErrorClass', 'required' =>'true')) }}
					        </div>
					    </div>
			    		
			    		<p class="errorInMobile p-0 m-0 text-danger hide"> </p>	

					    <div class="form-group row mt-4">
					        {{ Form::label('Email', null, ['class' => 'col-md-2 form-control-label']) }}
					        <div class="col-md-10">
					          {{ Form::text('email', $value =  null, $attributes = array('class'=>'form-control emailErrorClass', 'required' =>'true')) }}
					        </div>
					    </div>

					    <p class="bookedText"></p>

			    		<p class="errorInEmail p-0 m-0 text-danger hide"> </p>	

			            <div class="text-center my-3">
			                <button class="btn-sm btn btn-success saveSlot"> Continue</button>
			            </div>			          
			        </div>

		        </div>

		    </div>
	    </form>
	</div>
    
</div>

@include('site.home.interviewLogin')


@stop

@section('custom_js')

<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>


<script type="text/javascript">
jQuery('.selectTimeUrl').click(function(){
	var timeStart = $(this).parents('.slot').find('.timepicker').val();
	var timeEnd = $(this).parents('.slot').find('.timepicker1').val();
	var datepicker = $(this).parents('.slot').find('.datepicker').val();

	// for id of interview and slot
	
	var interview_id = $(this).parents('.slot').find('.interviewIDinInputType').val();
	var slot_id = $(this).parents('.slot').find('.slotIDinInputTypeInSlot').val();
	$('.slotIDinInputType').val(slot_id);

	// for id of interview and slot end here

	$('.selectedTimeSlot').removeClass('d-none');
	$('.firstLayout').addClass('d-none');
	// $('.slots').addClass('d-none');


	console.log(timeStart);
	console.log(timeEnd);
	console.log(datepicker);
	$('.selectedTImePicker').val(timeStart);
	$('.selectedTimePicker1').val(timeEnd);
	$('.selectedDatePicker').val(datepicker);

});

	function topFunction() {
  	window.scrollTo({top: 0, behavior: 'smooth'});
}


// =========================================================== Ajax for saving slot ===========================================================

$(document).ready(function(){

    $('.saveSlot').on('click',function() {
        event.preventDefault();
        var formData = $('.new_slot_form').serializeArray();
        // console.log('hi how are you');
        // console.log(' formData ', formData);
        $.ajax({
            type: 'POST',
            url:  '{{route('saveSlot')}}',
            data: formData,
            success: function(response){
                // console.log(' data ', response);
                if( response.status == 0 ) {
                    // that.hideMainEditor();

                   var errorIntCon = response['message'];
                   // console.log(errorIntCon);
                   var nameError = errorIntCon['name'];

                   var mobileError = errorIntCon['mobile'];
                   var emailError = errorIntCon['email'];
                   // console.log(' data ' + response);
                   // console.log(errorInNameCon);

                   // ==================== name validation ====================
                   if (nameError){
		               	var nameError2 = nameError.toString();
		                $('.errorInName').text(nameError2);
		                $('.errorInName').show();
		                // console.log(nameError);

                   	} else {
                   		$('.errorInName').hide();
                   	}
                    // ==================== name validation end here ====================

                   // ==================== mobile validation ====================
                   if (mobileError){
		               	var mobileError2 = mobileError.toString();
		                $('.errorInMobile').text(mobileError2);
		                $('.errorInMobile').show();
		                // console.log(nameError);

                   	} else {
                   		$('.errorInMobile').hide();
                   	}
                    // ==================== mobile validation end here ====================
                    // ==================== email validation ====================
                   if (emailError){
		               	var emailError2 = emailError.toString();
		                $('.errorInEmail').text(emailError2);
		                $('.errorInemail').show();
		                // console.log(nameError);

                   	} else {
                   		$('.errorInemail').hide();
                   	}
                    // ==================== email validation end here ====================


	                }


                else if(response.status == 2){
						var alreadBooked = response.error;                	 
						// console.log(alreadBooked);
						$('.bookedText').text(alreadBooked);
                }
                else{
                	location.href = base_url + '/interViewSlotCreated';

                }

            }
        });
    });

});

// =========================================================== Ajax for saving slot ===========================================================


</script>
@stop

@section('custom_css')

    {{-- <link rel="stylesheet" href="{{ asset('css/common.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/master.css') }}">


<style type="text/css">
	
	.errorInName{
		color: red;
	}
	.clickHere{
		text-decoration: underline;
	    color: black;
    	cursor: pointer;
	}
	body{
		overflow: auto;
	}
	.moreDetails{
		font-size: 15px;
	}
	.time{display: flex;}
	.slots{
		display: flex; 
		flex-wrap: wrap;
	}
</style>

@stop