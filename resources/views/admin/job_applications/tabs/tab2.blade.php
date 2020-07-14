<div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

	    <div class="form-group row">
		    {{ Form::label('questions', null, ['class' => 'col-md-2 form-control-label']) }}

{{-- @dump($answers) --}}

		  <div class="col-md-10">
			    @if(!empty($record->job->questions))
			        @foreach($record->job->questions as $qk => $question)
				        
				       	{{$question->title}} 
				           <p>	
				              @php
				         	  		$qanswer = isset($answers[$question->id])?($answers[$question->id]):null;
				         	  @endphp

				           	   @if(!empty($question->options))
				         	   		{{-- @dump($question->options) --}}
				         	   		@foreach ($question->options as $option)

				         	   		{{-- @dump($answers[$question->id]['id']) --}}
				         	   		{{-- @dump($answers[$question->id]) --}}

					         	   	<input  type="radio" class="btn btn-primary"  name="user_answers[{{$answers[$question->id]['id']}}]"  value="{{$option}}" {{($qanswer && ($qanswer['answer'] == $option))?'checked':''}}/> {{$option}}
				            	@endforeach

				            	@endif     

						    	{{-- @dump($question) --}}

					        @if(!empty($question->goldstar) && !empty($qanswer['answer']))
										@if(in_array($qanswer['answer'],$question->goldstar))  
										 	<span class="goldStar"><i class="fa fa-star"></i></span>
										@endif
					        @endif  
				         
				         </p>
				    @endforeach
							    @endif

		   </div> 
	    </div>

	 <a class="btn btn-primary btnPrevious text-white"onclick="scrollToTop()" >Previous</a>

</div>

