    
@extends('site.employer.uniqueUrlUnregisteredUser')

@section('content')

<div class="container">
	<div class="header text-center">
		<h4 class="font-weight-bold">Interview Concierge Bookings</h4>
	</div> 

	{{-- @dd($data['slot_data']->starttime); --}}

	@php
		$interviewPositionName = $data['interview_Data']->positionname;
		$interBookingData = $data ['Interviews_booking'];
		$interSlotData = $data ['slot_data'];
	@endphp

	<p class="p-0 m-0"> You have applied for the position of : <b>{{$interviewPositionName}}</b></p>
	<div class="slot1"> <p> Your slot for interview is with below timetable </p> </div>

	<div class="form-group row">
        {{ Form::label('From', null, ['class' => 'col-md-1 form-control-label']) }}
        <div class="col-md-2">
          {{ Form::text('Start Time', $value = $interSlotData->starttime , $attributes = array('class'=>'form-control')) }}
        </div>

        {{ Form::label('To', null, ['class' => 'col-md-1 form-control-label']) }}
        <div class="col-md-2">
          {{ Form::text('End TIme', $value = $interSlotData->endtime , $attributes = array('class'=>'form-control')) }}
        </div>
    </div>

    	<div class="form-group row">
        {{ Form::label('Date', null, ['class' => 'col-md-1 form-control-label']) }}
        <div class="col-md-2">
          {{ Form::text('date', $value = $interSlotData->date , $attributes = array('class'=>'form-control')) }}
        </div>
    </div>


	<div class="goHome text-center pb-3"> 
		<a href="{{route('homepage')}}"> Click here to go home page</a>
	</div>


	
		
    
    
</div>


@stop

@section('custom_js')

@stop

@section('custom_css')

<style type="text/css">
	
.col_center {
    width: 50% !important;
    padding-top: 14px;
    /*margin-top: 10% !important;*/
}

</style>

@stop