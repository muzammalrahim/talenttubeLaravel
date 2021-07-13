

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

		        <div class="j_button fl_right"><a class="graybtn jbtn m5" onclick="usePreviousResult({{$job->id}})">Use Previous Result</a></div>
		        <div class="j_button fl_right"><a class="graybtn jbtn proceedTest m5" data-jobid="{{$job->id}}">Redo Test</a></div>

		@else
		    <div class="w_25p fl_left">
		        <div class="j_button fl_right"><a class="graybtn jbtn proceedTest" data-jobid="{{$job->id}}">Yes</a></div>
		        <div class="j_button fl_right"><a class="graybtn jbtn m5 rejectTest">No</a></div>
		    </div>
		@endif

	</div>

	<div class="questionOnlineTest">
	    
</div>



