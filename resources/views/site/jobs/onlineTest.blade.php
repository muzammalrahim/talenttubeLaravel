

{{-- @if ($UserOnlineTest != null)
	@dump('hi test')

@else --}}

	<div class="onlineTestBox">
	    <div class="ja_description"> This job requires you to complete a mandatory online test, in order to be considered for the job. Do you agree to continue ? </div>

	    @if ($UserOnlineTest != null)
			{{-- @dump('hi test') --}}
			<div class="ja_description">
				We can see you’ve completed this same online test previously. Would you like to use your previous results, or would you like to complete the test again?
			</div>

	        <div class="j_button fl_right mx-2"><button class="orange_btn py-0 px-2" type="button" onclick="usePreviousResult({{$job->id}})">Use Previous Result</button></div>
	        <div class="j_button fl_right"><button class="orange_btn py-0 px-2" onclick="proceedTest()" type="button" data-jobid="{{$job->id}}">Redo Test</button></div>

		@else
	        <div class="bc-footer bg-white">
		        <div class="row">
		            <div class="col-lg-4 col-md-12 col-sm-12 col-12"></div>
		            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
		              <div class="b-card-btn">
		                <a type="button" class="orange_btn" onclick="rejectTest()"> <i class="far fa-times-circle"></i> No</a>
		                <button class="interview-tag used-tag" onclick="proceedTest()"><i class="far fa-check-circle"></i> Yes </button>
		              </div>
		            </div>
	          	</div>
			</div>
		@endif

	</div>

	<div class="questionOnlineTest">
	    
	</div>



