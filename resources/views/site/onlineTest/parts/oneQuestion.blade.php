{{-- <div class="add_new_job">
  		@php
  			$q = $UserOnlineTest->nextQuestion();
  			$count = $UserOnlineTest->onlineTest->testquestions->count();
  		@endphp
        <input type="hidden" name="remaining_time" class="timedb" value="{{$UserOnlineTest->rem_time}}">
			<form class="usersAnswer" name="usersAnswer">
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
					<input type="radio" value="1" name="users_answer" class="radioClick mb10" checked> <span class="testRadio">{{$q->option1}} </span><br>
		            <input type="radio" value="2" name="users_answer" class="radioClick mb10"><span class="testRadio"> {{$q->option2}} </span><br>
		            <input type="radio" value="3" name="users_answer" class="radioClick mb10"> <span class="testRadio">{{$q->option3}} </span><br>
		            <input type="radio" value="4" name="users_answer" class="radioClick mb10"> <span class="testRadio">{{$q->option4}} </span><br>
	            </div>
	            <input type="hidden" name="userOnlineTest_id" value="{{$UserOnlineTest->id}}">
                @if ($UserOnlineTest->current_qid == $count-1)
	                <a class="graybtn jbtn saveTestAndResult" >Save Test</a>
	            @else
	                <a class="graybtn jbtn nextQuestion" >Next Question</a>

                @endif

			</form>
</div> --}}



<section class="row">
   <div class="col-md-12">
   @php
   $q = $UserOnlineTest->nextQuestion();
   // dd($q);
   $count = $UserOnlineTest->onlineTest->testquestions->count();
   // dd($count);
   // dd($q->question);
   @endphp
   <div class="profile profile-section test-time clearfix">
      
      <div class="row">
        <div class="head icon_head_browse_matches col-12 col-lg-9">
           <h2>{{$UserOnlineTest->onlineTest->name}} Questions</h2>
        </div>
        <div class="col-12 col-sm-lg float-right float-lg-none">
          <div class="countdown fw-bold fs-2"> </div>
        </div>
      </div>
      <h2> <span> <input type="hidden" name="remaining_time" class="timedb" value="{{$UserOnlineTest->rem_time}}"></span></h2>
      <form class="usersAnswer" name="usersAnswer">
         <div class="row">
            @if (!empty($q->image_name) )
            <div class="col-sm-12 col-md-5 order-md-2 order-sm-1">
               <div class="test-img-wrap" >
                  <img src="{{ asset('media/public/onlineTest/' . $q->image_name ) }}" height="281px" alt="img" />
               </div>
            </div>
            @endif  
            <div class="col-sm-12 col-md-6 order-md-1 order-sm-2">
               <input type="hidden" name="qid" value="{{$q->id}}">
               <div class="job-box-info block-box clearfix">
                  <div class="box-head">
                     <h4 class="text-white">{{$q->question}}</h4>
                  </div>
                  <ul class="select-answer">
                     <li>
                        <div class="form-check emp-redio">
                           <input type="radio" value="1"  id="test1" name="users_answer" checked>
                           <label for="test1">{{$q->option1}}</label>
                        </div>
                     </li>
                     <li>
                        <div class="form-check emp-redio">
                           <input type="radio"  value="2" id="test2" name="users_answer">
                           <label for="test2">{{$q->option2}}</label>
                        </div>
                     </li>
                     <li>
                        <div class="form-check emp-redio">
                           <input type="radio" value="3"  id="test3" name="users_answer" >
                           <label for="test3">{{$q->option3}}</label>
                        </div>
                     </li>
                     <li>
                        <div class="form-check emp-redio">
                           <input type="radio"  value="4" id="test4" name="users_answer">
                           <label for="test4">{{$q->option4}}</label>
                        </div>
                     </li>
                  </ul>
                  <input type="hidden" name="userOnlineTest_id" value="{{$UserOnlineTest->id}}">
               </div>
            </div>
         </div>
         <div class="button-start">
            @if ($UserOnlineTest->current_qid == $count-1)
            <button type="button" class="orange_btn start-btn jbtn saveTestAndResult"><i class="fas fa-angle-right"></i> Save Test</button>
            @else
            <button type="button" class="orange_btn start-btn jbtn nextQuestion"><i class="fas fa-angle-right"></i> Next Question</button>
            @endif
         </div>
      </form>
   </div>
</section>