

{{-- <form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation"> --}}

<div class="container1 p-0">	
	@foreach ($interviewTemplate as $template)
	<div class="templates template_{{$template->id}} mb-2">
		<div class="font11"><span class="test font11"> 
			<b> Template Name: </b> {{$template->template_name}} <b> Type: </b> {{$template->type}} </span> 
        </div>
	@endforeach
    <h6 class="m-1 text-center font-weight-bold"> Questions </h6>
	@foreach ($InterviewTempQuestion as $key=> $quest)
		<div class="font11"> <b> Question:{{$loop->index+1}}  </b> 
			<span class="test font11" name = "question[{{$key+1}}]">{{$quest->question}} </span>
            <input type="text" class="w100 mt-2 d-none form-control answersInput" name="answer[{{$quest->id}}]">



        </div>
	@endforeach
    </div>
    {{-- <button class="btn btn-sm btn-primary conductInterview123 float-left mt-2" value="{{$template->id}}" >Conduct Interview</button>  --}}
    <input type="hidden" name="temp_id" value="{{$template->id}}">

    <span class="btn btn-sm btn-primary conductInterview123" temp_id="{{$template->id}}" >Correspondence Interview</span> 

    <span class="btn btn-sm btn-primary liveInterviewButton pointer" value="{{$template->id}}" >Live Interview</span> 
    <span class="btn btn-sm btn-primary liveInterview pointer d-none" value="{{$template->id}}" >Save Response</span> 


    <div class="conductIntLoader spinner-border text-primary text-primary mt-2 d-none" role="status"></div>
    <div class="errorInRecor d-inline-block text-danger">
    	<p class="recordalreadExist font11 d-none"></p>
    	<span class="liveInterviewError font11 d-none"></span>
    </div>
</div>

{{-- </form> --}}



