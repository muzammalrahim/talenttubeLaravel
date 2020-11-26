    
{{-- @extends('mobile.intConUsers.intConMaster') --}}
{{-- @section('content') --}}

<div class="container1 p-0">

	{{-- @dump($slot); --}}
		
		<div class="card-body p-0">
			@foreach ($slots as $slot)
				<div class="slotData p-3">
					<div class="form-group row">
			            {{ Form::label('From', null, ['class' => 'col-md-3 form-control-label']) }}
			            <div class="col-md-3">
			              {{ Form::text('endtime', $value = $slot->starttime, $attributes = array('class'=>'form-control starttime', 'readonly'=>'true')) }}
			            </div>

			            {{ Form::label('To', null, ['class' => 'col-md-3 form-control-label']) }}
			            <div class="col-md-3">
			              {{ Form::text('endtime', $value = $slot->endtime, $attributes = array('class'=>'form-control endtime', 'readonly'=>'true')) }}
			            </div>
			        </div>

			        <div class="form-group row">
			            {{ Form::label('Date', null, ['class' => 'col-md-3 form-control-label']) }}
			            <div class="col-md-9">
			              {{ Form::text('date', $value = Carbon\Carbon::parse($slot->date)->format('Y-m-d'), $attributes = array('class'=>'form-control date', 'readonly'=>'true')) }}
			            </div>
			        </div>
			        <div class="row">
			        	<div class="col-md-3"></div>
			        	<div class="col-md-9">
			        		<button class="btn btn-sm btn-primary rescheduleSlot" data-dismiss="modal"> Select this Slot </button>	 
			        	</div>
			        </div>
		        	<input type="hidden" name="Slot_id" value="{{$slot->id}}" class="slotIDHidden">
		        	<input type="hidden" name="bookingID" value="" class="bookingID">
			        
		        </div>
			@endforeach
		</div>
</div>

<script type="text/javascript">

$('.rescheduleSlot').click(function(){
    	$('#overlay').removeClass('d-none');
    	var slot_id = $(this).parents('.slotData').find('.slotIDHidden').val();
    	var booking_id = $(this).parents('.modal-body').find('.bookingIdINModal').val();
    	console.log(booking_id);
		event.preventDefault();

      	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MrescheduleSlot',
        // data:{id: id, starttime:starttime,endtime:endtime,date:date},
        data:{slot_id: slot_id,booking_id:booking_id},
        success: function(data){
            console.log(' data ', data);
            // $('.sendNotification').html('Save').prop('disabled',false);
            if( data.status == 1 ){
		    	$('#overlay').addClass('d-none');
		    	
		    	$('.successMsgUpdatingBooking').removeClass('d-none');
                setTimeout(function() {
        		$('.successMsgUpdatingBooking').addClass('d-none');
                location.reload();
                }, 3000);
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
 

 

<style type="text/css">

.columnCenters1{
	padding-top: 0px !important;
}

.slotData:nth-child(odd) { background-color:#fffff0;}
.slotData:nth-child(even) { background-color:#e0e0e0;}


</style>

 