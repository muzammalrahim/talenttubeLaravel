

<div class="container p-0">	
	<div class="notes note_{{$onlineTestTemplate->id}} mb-2">
		<div class="mb-2"> <b> Template  </b> <span class="test qualifType">{{$onlineTestTemplate->index+1}}: 
			<b> Name </b> {{$onlineTestTemplate->name}} <b> Time: </b> {{$onlineTestTemplate->time}} Minutes </span> 
        </div>
    <h3 class="text-center font-weight-bold"> Questions </h3>
	@foreach ($onlineTestTemplate->testQuestions as $key=> $quest)
		<div class="mb-2"> <b> Question:{{$loop->index+1}}  </b> 
			<span class="test qualifType" name = "question[{{$key+1}}]">{{$quest->question}} </span>
        </div>

        <div class="row">
        	<div class="mb-2 col-md-2"> <b> Options: </b></div>
        	<div class="mb-2 col-md-2"> <b> Options:1</b> 
				<span class="test qualifType" name = "">{{$quest->option1}} </span>
        	</div>
        	<div class="mb-2 col-md-2"> <b> Options:2</b> 
				<span class="test qualifType" name = "">{{$quest->option2}} </span>
        	</div>

        	<div class="mb-2 col-md-2"> <b> Options:3</b> 
				<span class="test qualifType" name = "">{{$quest->option3}} </span>
        	</div>

        	<div class="mb-2 col-md-2"> <b> Options:4</b> 
				<span class="test qualifType" name = "">{{$quest->option4}} </span>
        	</div>
        </div>

        @if (!empty($quest->image_name) )
          <div class="row form-group questionImage" >
            <div class="col-md-2 font-weight-bold">Question Image </div>
            <img data-photo-id=""  id="photo" style="height:50px"   class="photo" data-src="" src="{{ asset('media/public/onlineTest/' . $quest->image_name ) }}" >
              {{-- src="http://localhost/talenttube/public/media/public/onlineTest/1616073022.jpg" > --}}
            {{-- <div class="col-md-10"> <input type="file" name="question[1][questionImage]"> </div> --}}
          </div>
        @endif

        <hr>


	@endforeach
    </div>

    <input type="hidden" name="test_id" value="{{$onlineTestTemplate->id}}">
    <span class="btn btn-sm btn-success sendOnlineTest" data-tempId="{{$onlineTestTemplate->id}}"  onclick="sendOnlineTestFunction()">Send Online Test</span> 

    <div class="spinner-border text-dark sendInterviewLoader d-none" role="status">
	  <span class="sr-only">Loading...</span>
	</div>

    <p>
	    <span class="recordalreadExist d-none">
       
        </span>

	    <span class="liveInterviewError d-none"></span> 
	</p>

</div>
