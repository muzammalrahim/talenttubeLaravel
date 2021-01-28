
<div class="container1 p-0">	
		@foreach ($interviewTemplate as $template)
		<div class="notes note_{{$template->id}} mb10">
			<div class="pb20"> <b> Template  </b> <span class="test">{{$template->index+1}}: 
				<b> Name </b> {{$template->template_name}} <b> Type: </b> {{$template->type}} </span> 
            </div>
		@endforeach
				@foreach ($InterviewTempQuestion as $quest)
			<div class="pb20"> <b> Question:{{$loop->index+1}}  </b> 

				<span class="test">{{$quest->question}} </span> 
            </div>
		@endforeach

		{{-- <input type="text" name="" value="{{$jobSeeker->id}}" class="jsId"> --}}
</div>

<button class="btn small leftMargin turquoise conductInterview123" value="{{$template->id}}" >Conduct Interview</button> <span class="recordalreadExist hide_it"></span>


<script type="text/javascript">
	$('.rescheduletemplate').click(function(){
    	var template_id = $(this).parents('.template').find('.templateIDHidden').val();
    	var booking_id = $(this).parents('.modal-body').find('.bookingIdINModal').val();
    	$('#overlay').removeClass('d-none');
    	console.log(booking_id);
		event.preventDefault();

      	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
        type: 'POST',
        url: base_url+'/ajax/rescheduletemplate',
        // data:{id: id, starttime:starttime,endtime:endtime,date:date},
        data:{template_id: template_id,booking_id:booking_id},
        success: function(data){
            console.log(' data ', data);
            // $('.sendNotification').html('Save').prop('disabled',false);
            if( data.status == 1 ){
    			// $('.preferredtemplateLoader').hide();
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

.template:nth-child(odd) { background-color:#e0e0e0;}


</style>
{{-- 
@stop --}}