    
@extends('site.employer.sendPreferrredMaster')

@section('content')

<div class="container1 p-0">
	{{-- <div class="header text-center">
		<h4 class="font-weight-bold">Rescedule Interview</h4>
	</div>  --}}

	{{-- @dump($slot); --}}
		
		@foreach ($slots as $slot)

		<div class="slotData p-3">
			<div class="form-group row">
	            {{ Form::label('From', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-3">
	              {{ Form::text('Start Time', $value = $slot->starttime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
	            </div>

	            {{ Form::label('To', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-3">
	              {{ Form::text('Start Time', $value = $slot->starttime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
	            </div>
	        </div>

	        <div class="form-group row">
	            {{ Form::label('Date', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-9">
	              {{ Form::text('Date', $value = Carbon\Carbon::parse($slot->date)->format('Y-m-d'), $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
	            </div>
	        </div>

	        <div class="row">
	        	<div class="col-md-3"></div>
	        	<div class="col-md-9"><a href="" class="btn btn-primary" data-dismiss="modal"> Select this Slot</a></div>
	        </div>

        <input type="hidden" name="" value="{{$slot->id}}">
	        
        </div>

		@endforeach

	{{-- <div class="goHome text-center pb-3"> 
		<a href="{{route('homepage')}}"> Click here to go home page</a>
	</div> --}}

    
</div>


@stop

@section('custom_js')

@stop

@section('custom_css')

<style type="text/css">

.columnCenters1{
	padding-top: 0px !important;
}

.slotData:nth-child(odd) { background-color:#fffff0;}


</style>

@stop