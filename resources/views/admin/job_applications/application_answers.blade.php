
{{-- <div class="row"> --}}
	@if ($JobsAnswers->count() > 0)
		@foreach ($JobsAnswers as $answer)
			<div class="bgColor p-2">
				<div class="form-group row">
				    <label for="staticTitle_{{$answer->id}}" class="col-sm-4 col-form-label">Gold Star Questions</label>
				    <div class="col-sm-8">
				      <input type="text" readonly class="form-control-plaintext" id="staticTitle_{{$answer->id}}" value="{{$answer->question->title}}">
				    </div>

			  	</div>

			  	<div class="form-group row">
				    <label for="staticEmail_{{$answer->id}}" class="col-sm-4 col-form-label">Answer</label>
				    <div class="col-sm-8">
				    	<input type="text" readonly class="form-control-plaintext" id="staticTitle_{{$answer->id}}" value="{{$answer->answer}}">

				    </div>
			  	</div>
			</div>
		@endforeach
	@endif
{{-- </div> --}}


<style type="text/css">
	.bgColor:nth-child(odd) {
	  background: #dee2e6;
	}
</style>