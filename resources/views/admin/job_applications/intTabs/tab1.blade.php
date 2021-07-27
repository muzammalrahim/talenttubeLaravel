<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">


	{{-- @if (isset($UserInterview)) --}}
		{{-- expr --}}
	@if ($UserInterview->count() > 0)
		{{-- expr --}}
	
	@foreach ($UserInterview as $int)
	
		{{-- @dump($int->template) --}}

		<div class="row">
	      <div class="col-md-4"> <p  class="font-weight-bold"> Interview: {{$loop->index+1}} </p></div>
	      <div class="col-md-4"> <p> <span class="font-weight-bold">Employer:</span> {{$int->employer->company}}</p> </div>
	      <div class="col-md-4"> <p class="float-right"> <span class="font-weight-bold">Satus:</span> {{$int->status}} </p> </div>
	    </div>


	    <div class="row">
	      <div class="col-md-4"><p> <span class="font-weight-bold">Interview Type:</span> {{$int->template->type}} </p></div>
	      <div class="col-md-4"><p> <span class="font-weight-bold"> Template:</span> {{$int->template->template_name}} </p></div>
	    </div>


	    <div class="employerResponseDiv">

	    @if ($int->status == 'Interview Confirmed' )
            

	    <button class="btn btn-sm btn-primary seeEmployerResponse"> See Candidate's Response</button>

	    @php
	    	$temp_id = $int->temp_id;
            $emp_id = $int->employer->id;
            $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();

        @endphp
        <div class="employerResponse hide">
          @foreach ($tempQuestions as $question)
            <p class="qualifType p0"> <b>Question {{$loop->index+1}})</b> {{$question->question}} </p>
            @php
              $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('user_id', $user_id)->where('emp_id', $emp_id)->where('userInterview_id', $int->id)->first();   
            @endphp
            <p class="qualifType p0 mb10"> <b>Candidate's Response:</b> {{$answers->answer}} </p>
          @endforeach
        </div>

        @endif

        </div>
	    <hr>

	@endforeach
	@else 
		<h5 class="font-weight-bold"> No interview yet </h5>
	@endif
	{{-- @endif --}}


    <a class="btn btn-primary btnNext text-white" style="float: right;"onclick="scrollToTop()">Next</a>

</div>

