       


@if ($interview_booking->count() > 0)
	@foreach ($interview_booking as $booking)
		<p> <span class="bold">{{$loop->index+1}})  {{$jobSeeker->name}} </span>  has booked interview for the position of <span class="bold"> {{$booking->interview->positionname}} </span> </p>  
	@endforeach
@else
	<p> This user has not any booking yet</p>	
@endif


{{-- @dump($UserInterview) --}}

@include('site.user.jobseekerInfoTabs.userInterviewForJobseeker')   {{-- site/user/jobseekerInfoTabs/userInterviewForJobseeker --}}

    
<p> If you want to conduct interview of <b> {{$jobSeeker->name}} </b> <span style="text-decoration: underline" class="pointer displayInterviewTemplate">  Click Here </span>  to see the available templates.</p>

<div class="tempDisplayforemployer hide_it job_row">
	<form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation">
	@csrf
		<div class="job_title form_field job_heading p10">
			<p class="w20 form_label bold qualifType">Interview Template:</p>
			<select class="templateSelect" name="templateSelect" >
				<option value="0"> Select Template</option>
				@foreach ($interviewTemplate as $template)
					<option value="{{ $template->id }}"> 
						{{$template->template_name}} 
					</option>
				@endforeach
			</select>
			<span class="btn small leftMargin turquoise interviewLoader"></span>
		</div>
	</form>

    {{-- ========================== Get Template and questions through aja and embed them in below div ========================== --}}
    
    <form method="POST" name="interviewTemplateSave" class="interviewTemplateSave newJob job_validation">
        <div class="templateData p10"></div>

        <input type="hidden" name="user_id" value="{{$jobSeeker->id}}" class="jsId">



        {{-- <button type="button"> Save response</button> --}}
    </form>

</div>

<input type="hidden" name="" value="{{$jobSeeker->id}}" class="jsId">


<script type="text/javascript">
	
	{{-- ===================================== Hide Show interview Template on click ===================================== --}}

	$(document).on("click" , ".displayInterviewTemplate" , function(){
		$('.tempDisplayforemployer').toggleClass('hide_it');
	});

	{{-- ===================================== Hide Show interview Template on click ===================================== --}}

	$('.interviewTemplate').on('change',function() {
    event.preventDefault();
    var formData = $('.interviewTemplate').serializeArray();
    $('.interviewLoader').html(getLoader('pp_profile_edit_main_loader interviewTemplateLoader')).prop('disabled',true);
    console.log(' formData ', formData);
    $('.general_error1').html('');
    	$.ajax({
        	type: 'POST',
       		url: base_url+'/ajax/interview/template',
        	data: formData,
            success: function(data){
                // console.log(' data ', data);
                $('.interviewTemplateLoader').addClass('hide_it');
            	$('.interviewLoader').prop('disabled',false);
                $('.templateData').html(data);
            }
    	});
	});


    // ============================================ Conduct Interview ============================================

    $(document).on("click" , ".conductInterview123" , function(){
        var inttTempId = $('.conductInterview123').val();
        var user_id = $('.jsId').val();
        console.log(user_id);
        $('.conductInterview123').html(getLoader('pp_profile_edit_main_loader conductInterviewLoader')).prop('disabled',true);
        $('.general_error1').html('');
        $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/conduct/interview',
            data: {inttTempId,user_id},
            success: function(response){
                if(response.status == 1){
                    
                    var message = response.message;
                    $('.recordalreadExist').removeClass('hide_it').text(message);
                    $('.conductInterviewLoader').addClass('hide_it');
                    $('.interviewTemplateLoader').addClass('hide_it');
                    $('.conductInterview123').html('Interview Conducted').prop('disabled',false);
                    setTimeout(function(){
                    $('.recordalreadExist').addClass('hide_it'); },
                    3000);  
                    location.reload();

                    // window.location.href = "{{ route('intetviewInvitationEmp')}}" ;

                }
                else{

                    var message = response.message;
                    // var abc = response.messge
                    $('.recordalreadExist').removeClass('hide_it').text(message);
                    $('.interviewTemplateLoader').addClass('hide_it');
                    $('.conductInterview123').html('Error Occured').prop('disabled',false);
                    setTimeout(function(){
                    $('.recordalreadExist').addClass('hide_it'); },
                    3000);

                }
                

            }
        });

    });





    // ============================================ Live Interview button ============================================

    $(document).on('click' , '.liveInterviewButton', function (){
        $('.answersInput').removeClass('hide_it');
        $('.liveInterview').removeClass('hide_it'); 
        $('.liveInterviewButton').addClass('hide_it'); 
        $('.conductInterview123').addClass('hide_it');
    });

    // ============================================ Live Interview ============================================
    

    $(document).on("click" , ".liveInterview" , function(){
        var formData = $('.interviewTemplateSave').serializeArray();
        $('.liveInterview').html(getLoader('pp_profile_edit_main_loader liveInterviewTemplateLoader')).prop('disabled',true);
        console.log(' formData ', formData);
        // return;
        $('.general_error1').html('');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/live/interview',
                data: formData,
                success: function(response){
                if(response.status == 1){
                    var message = response.message;
                    // console.log(message);
                    $('.liveInterviewError').removeClass('hide_it').text(message);
                    $('.conductInterviewLoader').addClass('hide_it');
                    $('.liveInterviewTemplateLoader').addClass('hide_it');
                    $('.liveInterview').html('Interview Saved').prop('disabled',false);
                    location.reload();
                    setTimeout(function(){
                    $('.liveInterviewError').addClass('hide_it'); },
                    3000);  
                    // window.location.href = "{{ route('intetviewInvitationEmp')}}" ;
                }
                else{
                    var message = response.message;
                    $('.liveInterviewError').removeClass('hide_it').text(message);
                    $('.liveInterviewTemplateLoader').addClass('hide_it');
                    $('.liveInterview').html('Live Interview').prop('disabled',false);
                    setTimeout(function(){
                    $('.liveInterviewError').addClass('hide_it'); },
                    3000);

                }
            }
            });



    });

</script>