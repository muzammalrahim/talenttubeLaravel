<div class="add_new_job">
  		@php
  			$q = $UserOnlineTest->nextQuestion();
  			$count = $UserOnlineTest->onlineTest->testquestions->count();
  			// dd($count);
  			// dd($q->question);	
  		@endphp
		{{-- @dump($UserOnlineTest->rem_time) --}}
        <input type="hidden" name="remaining_time" class="timedb" value="{{$UserOnlineTest->rem_time}}">
			<form class="usersAnswer" name="usersAnswer">
				{{-- <p> {{$q->question}} </p> --}}

				<div class="job_heading dflex">
	                <div class="w_80p p10">
	                    <h3 class=" job_title"><a>{{$q->question}}</a></h3>
	                </div>
	                <div class="w_20p">
	                    @if (!empty($q->image_name) )
			            <div class="row form-group questionImage">
			                <img data-photo-id=""  id="photo" style="height:108px"   class="photo" data-src="" 
			                src="{{ asset('media/public/onlineTest/' . $q->image_name ) }}" >
			            </div>
			            @endif
	                </div>
            	</div>
				<input type="hidden" name="qid" value="{{$q->id}}">
				<div class="p10">
					{{-- <input type="radio" value="1" name="users_answer" class="radioClick mb10" checked> <span class="testRadio">{{$q->option1}} </span><br>
		            <input type="radio" value="2" name="users_answer" class="radioClick mb10"><span class="testRadio"> {{$q->option2}} </span><br>
		            <input type="radio" value="3" name="users_answer" class="radioClick mb10"> <span class="testRadio">{{$q->option3}} </span><br>
		            <input type="radio" value="4" name="users_answer" class="radioClick mb10"> <span class="testRadio">{{$q->option4}} </span><br> --}}


		            <div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" value="1" id="defaultGroupExample1" name="users_answer" checked>
					  <label class="custom-control-label" for="defaultGroupExample1">{{$q->option1}}</label>
					</div>

					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" value="2" id="defaultGroupExample2" name="users_answer" >
					  <label class="custom-control-label" for="defaultGroupExample2">{{$q->option2}}</label>
					</div>

					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" value="3" id="defaultGroupExample3" name="users_answer">
					  <label class="custom-control-label" for="defaultGroupExample3">{{$q->option3}}</label>
					</div>

					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" value="4" id="defaultGroupExample4" name="users_answer">
					  <label class="custom-control-label" for="defaultGroupExample4">{{$q->option4}}</label>
					</div>





	            </div>
	            <input type="hidden" name="userOnlineTest_id" value="{{$UserOnlineTest->id}}">
                @if ($UserOnlineTest->current_qid == $count-1)
	                <a class="btn btn-sm btn-primary graybtn jbtn saveTestAndResult" >Save Test</a>
	            @else
	                <a class="btn btn-sm btn-primary nextQuestion" >Next Question</a>

                @endif

			</form>
</div>