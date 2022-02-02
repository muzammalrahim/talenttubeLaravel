
<div class="container1 p-0">

	@php
		// $totalMaxmumInterviewBookings = [] ; 
		// $total_boking = [] ;
		$slotSum = 0;
		$bookingsSum = 0;

		foreach ($slots as $slot) {
			// $totalMaxmumInterviewBookings[] .= (int)$slot->maximumnumberofinterviewees;
			// $total_boking[] .= (int)( $slot->bookings_count? $slot->bookings_count->aggregate:0);
			$slotSum = $slotSum + $slot->maximumnumberofinterviewees;
			$bookingsSum= $bookingsSum + ( $slot->bookings_count? $slot->bookings_count->aggregate:0);
		}

	@endphp

	@if ( $bookingsSum < $slotSum )
		{{-- expr --}}
		@foreach ($slots as $slot)

		@php
			$slotBooking = $slot->bookings_count? $slot->bookings_count->aggregate:0;
		@endphp

		@if ($slotBooking < $slot->maximumnumberofinterviewees )

			<div class="slotData p-3">
				{{-- @dump($slot->maximumnumberofinterviewees) --}}
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
		        	<div class="btn btn-primary col-md-3 rescheduleSlot" data-dismiss="modal" >  Select this Slot</div>
		        </div>

			    <input type="hidden" name="" value="{{$slot->id}}" class="slotIDHidden">
			    {{-- <input type="text" name="bookingID" value="" class="bookingID"> --}}
	        </div>

	    @endif
		@endforeach
	@else

	    <div class="slotData p-3">
	    	<p> No interview time slots available, please contact <a href="mailto:admin@talenttube.org">admin@talenttube.org</a> to discuss </p>
	    </div>

	@endif


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
        		// $('.successMsgUpdatingBooking').removeClass('d-none');
                /*setTimeout(function() {
        		$('.successMsgUpdatingBooking').addClass('d-none');
                location.reload();
                }, 3000);*/

            	$('#slotUpdatedModal').modal('show');

                var html = '<div class="modal-body p-0">';
					html +=        '<div class="text-center my-4 warning_text">';
					html +=            'Your interview slot has been updated successfully.';
					html +=        '</div>';
					html +=        '<div class="ajaxDataOfSlots"></div>';
					html +=      '</div>';

                // $('.ajaxDataOfSlots').html(html);
            	// $('#bookingDeletedModal').modal('show');
            	// $('.warning_text').text(' Your interview slot has been updated successfully. ');

                // $('.ajaxDataOfSlots').html(data);


            }
            else if( data.status == 0 ){
                $('#overlay').addClass('d-none');
            	$('#errorReschedulingSlot').modal('show');
            }
            else{

                $('#overlay').addClass('d-none');
        		$('.successMsgUpdatingBooking').addClass('d-none');
               
            }

        }
    });

});

this.removeOverlay = function(){
    $('#overlay').addClass('d-none');
    $('#errorReschedulingSlot').modal('hide');


}
</script>

<style type="text/css">

.columnCenters1{
	padding-top: 0px !important;
}

.slotData:nth-child(odd) { background-color:#e0e0e0;}


</style>
{{-- 
@stop --}}