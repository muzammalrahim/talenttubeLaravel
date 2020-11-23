
    
@extends('mobile.intConUsers.intConMaster')

@section('content')


<div class="card shadow mb-3 bg-white rounded">

{{-- <div class="container card"> --}}

	<h6 class="card-header h6"> Interview Concierge Bookings</h6>

	{{-- @dd($data['Interviews_booking']); --}}
    <div class="card-body p-2 cardBody">
    	<div class="interviewBookings">
            @foreach ($data['Interviews_booking'] as $int_booking )
                <div class="interviewBooking">
                    {{-- @dump($int_booking->slot->starttime); --}}
                    <p class="p-0 m-0"> You have applied for the position of : <b>{{$int_booking->interview->positionname}}</b></p>
                    
                    <div class="slot1 row"> 
                        <div class="col-md-6"> <p> Your slot for interview is with below timetable </p> </div>
                        <div class="col-md-6"><a href="" class=""> Click here to cancel your interview</a>
                        </div>
                    </div>
                        {{-- <button class="deleteSlotButton float-right "> Hi How are</button> --}}

                    <div class="form-group row">
                        {{ Form::label('From', null, ['class' => 'col-md-1 form-control-label']) }}
                        <div class="col-md-2">
                          {{ Form::text('Start Time', $value = $int_booking->slot->starttime, $attributes = array('class'=>'form-control')) }}
                        </div>

                        {{ Form::label('To', null, ['class' => 'col-md-1 form-control-label']) }}
                        <div class="col-md-2">
                          {{ Form::text('End TIme', $int_booking->slot->endtime, $attributes = array('class'=>'form-control')) }}
                        </div>

                        <div class="col-md-6">
                          <a href="" class=""> Click here to send an email to the interviewer with your preferred time</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Date', null, ['class' => 'col-md-1 form-control-label']) }}
                        <div class="col-md-2">
                            {{ Form::text('date', $int_booking->slot->date , $attributes = array('class'=>'form-control')) }}
                        </div>
                    </div>

                </div>
            @endforeach
    </div>

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