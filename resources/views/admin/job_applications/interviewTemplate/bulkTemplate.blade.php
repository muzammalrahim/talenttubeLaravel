




<div class="container p-0">	
	@foreach ($interviewTemplate as $template)
	<div class="notes note_{{$template->id}} mb-2">
		<div class="mb-2"> <b> Template  </b> <span class="test qualifType">{{$template->index+1}}: 
			<b> Name </b> {{$template->template_name}} <b> Type: </b> {{$template->type}} </span> 
        </div>
	@endforeach
    <h3 class="text-center font-weight-bold"> Questions </h3>
	@foreach ($InterviewTempQuestion as $key=> $quest)
		<div class="mb-2"> <b> Question:{{$loop->index+1}}  </b> 
			<span class="test qualifType" name = "question[{{$key+1}}]">{{$quest->question}} </span>
            {{-- <input type="text" class="form-control mt-2 d-none answersInput" name="answer[{{$quest->id}}]"> --}}

        </div>
	@endforeach
    </div>

    <input type="hidden" name="temp_id" value="{{$template->id}}">
    <span class="btn btn-sm btn-success conductInterview123" data-tempId="{{$template->id}}" >Correspondence Interview</span> 

   {{--  <span class="btn btn-sm btn-success liveInterviewButton pointer" value="{{$template->id}}" >Live Interview</span> 
    <div class="text-center">
    	<button class="btn btn-sm btn-primary liveInterview pointer d-none mt-3" value="{{$template->id}}" >Save Response</button> 
	</div> --}}

    <p>
	    <span class="recordalreadExist d-none"></span>

	    <span class="liveInterviewError d-none"></span> 
	</p>

</div>
