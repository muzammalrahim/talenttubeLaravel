    
@extends('mobile.intConUsers.intConMaster')

@section('content')

<div class="container1 p-0">
	{{-- <div class="header text-center">
		<h4 class="font-weight-bold">Rescedule Interview</h4>
	</div>  --}}

	{{-- @dump($slot); --}}
		
		<div class="card-body p-0">
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
		        	<div class="col-md-9">
		        		<button class="btn btn-sm btn-primary rescheduleSlot"> Select this Slot </button>	 
		        	</div>
		        </div>

	        <input type="hidden" name="" value="{{$slot->id}}" class="slotIDHidden">
		        
	        </div>

			@endforeach
		</div>
	{{-- <div class="goHome text-center pb-3"> 
		<a href="{{route('homepage')}}"> Click here to go home page</a>
	</div> --}}

    
</div>


@stop

@section('custom_js')

<script type="text/javascript">

$('.rescheduleSlot').click(function(){
    
    var intbcd = $(this).parents('.slotData').find('.slotIDHidden').val();

    	console.log(intbcd);

      	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MrescheduleSlot',
        data:{id: intbcd},
        success: function(data){
            console.log(' data ', data);
            // $('.sendNotification').html('Save').prop('disabled',false);
            if( data.status == 1 ){
                // $('.deletingSpinner').addClass('d-none');
                // $('.successMsgDeleteBooking').removeClass('d-none');
                // setTimeout(function() {
                   // $('.successMsgDeleteBooking') .addClass('d-none');
                   // location.reload();
                // }, 3000);

            }else{
               
            }

        }
    });

});

</script>
@stop

@section('custom_css')

<style type="text/css">

.columnCenters1{
	padding-top: 0px !important;
}

.slotData:nth-child(odd) { background-color:#fffff0;}
.slotData:nth-child(even) { background-color:#e0e0e0;}


</style>

@stop