


@foreach ($jobApp as $job)
	
	<div class="bgColor p-2">
	  	<div class="form-group row">
		    <label for="staticTitle_{{$job->id}}" class="col-sm-3 col-form-label">Job Title</label>
		    <div class="col-sm-9">
		      <input type="text" readonly class="form-control-plaintext" id="staticTitle_{{$job->id}}" value="{{$job->job->title}}">
		    </div>
	  	</div>


	  	<div class="form-group row">
		    <label for="staticEmail_{{$job->id}}" class="col-sm-3 col-form-label">Description</label>
		    <div class="col-sm-9">
		      <textarea type="text" readonly rows="4" class="form-control-plaintext" id="staticEmail_{{$job->id}}" value=""> {{$job->description}} </textarea>
		    </div>
	  	</div>


	  	<div class="form-group row">
		    <label for="staticStatus_{{$job->id}}" class="col-sm-3 col-form-label">Status</label>
		    <div class="col-sm-9">
		      <input type="text" readonly class="form-control-plaintext status" id="staticStatus_{{$job->id}}" data-status= "{{$job->status}}" value=" {{$job->status}} "> 
		    </div>
	  	</div>

	  	<button class="btn btn-primary my-3 selectJobButton" value="{{$job->id}}" data-dismiss="modal"> Select this job </button>
	  	<input type="hidden" class="user_id" name="" value="{{$job->jobseeker->id}}">


	</div>




@endforeach


<style type="text/css">
	
	.bgColor:nth-child(odd) {
	  background: #dee2e6;
	}

</style>