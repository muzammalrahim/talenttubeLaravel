

{{-- <form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation"> --}}

<div class="container1 p-0">	
	@foreach ($interviewTemplate as $template)
	<div class="notes note_{{$template->id}} mb10">
		<div class="mb10"> <b> Template  </b> <span class="test qualifType">{{$template->index+1}}: 
			<b> Name </b> {{$template->template_name}} <b> Type: </b> {{$template->type}} </span> 
        </div>
	@endforeach
    <h3 class="center bold"> Questions </h3>
	@foreach ($InterviewTempQuestion as $key=> $quest)
		<div class="mb10"> <b> Question:{{$loop->index+1}}  </b> 
			<span class="test qualifType" name = "question[{{$key+1}}]">{{$quest->question}} </span>
            <input type="text" class="w100 mt10 hide_it answersInput" name="answer[{{$quest->id}}]">

        </div>
	@endforeach
    </div>

    <input type="hidden" name="temp_id" value="{{$template->id}}">
    <button class="btn small leftMargin turquoise conductInterview123" value="{{$template->id}}" >Correspondence Interview</button> 

    <span class="btn small leftMargin turquoise liveInterviewButton pointer" value="{{$template->id}}" >Live Interview</span> 
    <button class="btn small leftMargin turquoise liveInterview pointer hide_it" value="{{$template->id}}" >Save Response</button> 

    <p>
	    <span class="recordalreadExist hide_it"></span>

	    <span class="liveInterviewError hide_it"></span> 
	</p>

</div>

{{-- </form> --}}

<script type="text/javascript">


// $(document).on("click" , ".conductInterview123" , function(){
//         var inttTempId = $('.conductInterview123').val();
//         var user_id = $('.jsId').val();
//         console.log(user_id);
//         $('.conductInterview123').html(getLoader('pp_profile_edit_main_loader conductInterviewLoader')).prop('disabled',true);
//         $('.general_error1').html('');
//         $.ajaxSetup({
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
//         $.ajax({
//             type: 'POST',
//             url: base_url+'/ajax/conduct/interview',
//             data: {inttTempId,user_id},
//             success: function(response){
//                 if(response.status == 1){
                    
//                     var message = response.message;
//                     $('.recordalreadExist').removeClass('hide_it').text(message);
//                     $('.conductInterviewLoader').addClass('hide_it');
//                     $('.interviewTemplateLoader').addClass('hide_it');
//                     $('.conductInterview123').html('Interview Conducted').prop('disabled',false);
//                     setTimeout(function(){
//                     $('.recordalreadExist').addClass('hide_it'); },
//                     3000);  

//                     window.location.href = "{{ route('intetviewInvitationEmp')}}" ;

//                 }
//                 else{

//                     var message = response.message;
//                     // var abc = response.messge
//                     $('.recordalreadExist').removeClass('hide_it').text(message);
//                     $('.interviewTemplateLoader').addClass('hide_it');
//                     $('.conductInterview123').html('Error Occured').prop('disabled',false);
//                     setTimeout(function(){
//                     $('.recordalreadExist').addClass('hide_it'); },
//                     3000);

//                 }
                

//             }
//         });

//     });



</script>

<style type="text/css">

.columnCenters1{
	padding-top: 0px !important;
}

.template:nth-child(odd) { background-color:#e0e0e0;}

.liveInterviewButton {
    background: #40c7db;
    padding: 7px 25px;
    color: white;
}
.liveInterviewButton:hover{
	background: #015761;
}
</style>
{{-- 
@stop --}}