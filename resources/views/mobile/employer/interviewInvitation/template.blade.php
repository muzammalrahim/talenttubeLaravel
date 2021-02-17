

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
        </div>
	@endforeach
    </div>
    <button class="btn btn-sm btn-primary conductInterview123 float-left mt-2" value="{{$template->id}}" >Conduct Interview</button> 

    <div class="conductIntLoader spinner-border text-primary text-primary mt-2 d-none" role="status"></div>
    <div class="errorInRecor d-inline-block text-danger">
    	<p class="recordalreadExist d-none"></p>
    </div>
</div>

{{-- </form> --}}



