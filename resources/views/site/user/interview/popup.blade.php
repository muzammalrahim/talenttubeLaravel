
<div style="display:none;">
<div id="DeleteInterviewModal" class="modal cmodal p0 DeleteInterviewModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Delete Booking</div>
            <div class="spinner_loader">
                <div class="spinner center">
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                    <div class="spinner-blade"></div>
                </div>
            </div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="apiMessage mt20"></div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey">Cancel</button>
                <button class="confirmDeleteInterview confirm_btn btn small marsh">Yes</button>
                <input type="hidden" name="interviewId" id="interviewId" val="">
                <div class="cl"></div>
            </div>
        </div>

    </div>
</div>
</div>


<script type="text/javascript">
	$('.deleteInterviewButton1').click(function(){
		var intId = $(this).attr('data-jobid');
		$('#interviewId').val(intId);
		console.log(intId);
		$('#DeleteInterviewModal').modal({
			fadeDuration: 200,
			fadeDelay: 2.5,
			escapeClose: false,
			clickClose: false,
		});
    });

	$('.confirmDeleteInterview').click(function(){
		var confirmDelete = $('#interviewId').val();
		console.log(confirmDelete);
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		$.ajax({
        type: 'POST',
        url: base_url+'/ajax/booking/deleteInterviewBooking',
        data:{id: confirmDelete},
        success: function(data){
          console.log(' data ', data);
          if( data.status == 1 ){
          	$('.DeleteInterviewModal .apiMessage').html(data.message);
          	$('.interviewBookingsRow_'+confirmDelete).remove();
            
          }else{
            // $('#overlay').addClass('d-none');
                $('#DeleteInterviewModal').hide();


          }
        }
      });


	});

	 

</script>