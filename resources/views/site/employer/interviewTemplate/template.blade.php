

{{-- <form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation"> --}}

	<div class="container1 p-0">	
		@foreach ($interviewTemplate as $template)
			<div class="notes note_{{$template->id}} mb10">
				<div class="mb10"> <b> Template  </b> <span class="test qualifType">{{$template->index+1}}: 
					<b> Name </b> {{$template->template_name}} <b> Type: </b> {{$template->type}} </span> 
		        </div>

		        @if ($template->employers_instruction)
		        	
			        <div class="dflex">
			            <div class="w20 bold">Instruction</div>
			            <div class="w80">  {{ $template->employers_instruction }}  </div>    
			        </div>

		        @endif

			</div>  
		@endforeach

	    <h3 class="center bold"> Questions </h3>
		@foreach ($InterviewTempQuestion as $key=> $quest)
			<div class="mb10 mt10"> <b> Question:{{$loop->index+1}}  </b> </div>
	        <div class="dflex">
				<div class="w80">
					<span class="test qualifType" name = "question[{{$key+1}}]">{{$quest->question}} </span>
				</div>
				<div class="w20">
					<input type="checkbox" {{($quest->video_response == 1)? 'checked': ''}}  > Video Response
				</div>
			</div>
			<input type="text" class="w100 mt10 hide_it answersInput" name="answer[{{$quest->id}}]">
		@endforeach

	    <input type="hidden" name="temp_id" value="{{$template->id}}"> 

	    <div class="mt10">
	    	<button class="btn small leftMargin turquoise conductInterview123" value="{{$template->id}}" >Correspondence Interview</button> 
		    <span class="btn small leftMargin turquoise liveInterviewButton pointer" value="{{$template->id}}" >Live Interview</span> 
		    <button class="btn small leftMargin turquoise liveInterview pointer hide_it" value="{{$template->id}}" >Save Response</button> 
	    </div>
	    

	    <p>
		    <span class="recordalreadExist hide_it"></span>

		    <span class="liveInterviewError hide_it"></span> 
		</p>

	</div>

{{-- </form> --}}


<style type="text/css">

.columnCenters1{ padding-top: 0px !important;}
.template:nth-child(odd) { background-color:#e0e0e0;}
.liveInterviewButton { background: #40c7db;padding: 7px 25px;color: white;}
.liveInterviewButton:hover{background: #015761;}
</style>
{{-- 
@stop --}}