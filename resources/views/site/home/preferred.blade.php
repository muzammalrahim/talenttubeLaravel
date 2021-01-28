
<div class="container1 p-0">	
		@foreach ($slots as $slot)

		<div class="slotData p-3">
			<div class="form-group row">
	            {{ Form::label('From', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-3">
	              {{ Form::text('starttime', $value = $slot->starttime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
	            </div>

	            {{ Form::label('To', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-3">
	              {{ Form::text('endtime', $value = $slot->endtime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
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
	        	<div class="btn btn-primary col-md-3 rescheduleSlot" data-dismiss="modal">  Select this Slot</div>
	        </div>

		        <input type="hidden" name="" value="{{$slot->id}}" class="slotIDHidden">
		    	{{-- <input type="text" name="bookingID" value="" class="bookingID"> --}}
        </div>

		@endforeach

</div>


<script type="text/javascript">
	$('.rescheduleSlot').click(function(){
    	var slot_id = $(this).parents('.slotData').find('.slotIDHidden').val();
    	var booking_id = $(this).parents('.modal-body').find('.bookingIdINModal').val();
    	$('#overlay').removeClass('d-none');
    	console.log(booking_id);
		event.preventDefault();

      	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
        type: 'POST',
        url: base_url+'/ajax/rescheduleSlot',
        // data:{id: id, starttime:starttime,endtime:endtime,date:date},
        data:{slot_id: slot_id,booking_id:booking_id},
        success: function(data){
            console.log(' data ', data);
            // $('.sendNotification').html('Save').prop('disabled',false);
            if( data.status == 1 ){
    			// $('.preferredSlotLoader').hide();
                $('#overlay').addClass('d-none');
        		$('.successMsgUpdatingBooking').removeClass('d-none');
                setTimeout(function() {
        		$('.successMsgUpdatingBooking').addClass('d-none');
                location.reload();
                }, 3000);

            }else{
               
            }

        }
    });

});

</script>

<style type="text/css">

.columnCenters1{
	padding-top: 0px !important;
}

.slotData:nth-child(odd) { background-color:#e0e0e0;}


</style>
{{-- 
@stop --}}