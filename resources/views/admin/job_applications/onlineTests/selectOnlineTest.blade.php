

@if ($UserOnlineTest->count() > 0)

@foreach ($UserOnlineTest as $test)
	
	<div class="bgColor p-2">
	  	<div class="form-group row">
		    <label for="staticTitle_{{$test->id}}" class="col-sm-3 col-form-label">Test Name</label>
		    <div class="col-sm-9">
		      <input type="text" readonly class="form-control-plaintext" id="staticTitle_{{$test->id}}" value="{{$test->onlineTest->name}}">
		    </div>

	  	</div>


	  	<div class="form-group row">
		    <label for="staticEmail_{{$test->id}}" class="col-sm-3 col-form-label">Score</label>
		    <div class="col-sm-9">

		    	<input type="text" readonly class="form-control-plaintext" id="staticTitle_{{$test->id}}" value="{{$test->test_result}}">

		    </div>
	  	</div>

	</div>




@endforeach

@else
	<h5 class="my-5"> None Availabe </h5>
@endif

<style type="text/css">
	
	.bgColor:nth-child(odd) {
	  background: #dee2e6;
	}

</style>