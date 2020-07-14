<div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    
    {{-- @dump($record->questions) --}}

    <div class="col-md-10">
    @if(!empty($record->questions))
        @foreach($record->questions as $qk => $question)
	           <div class="questionbox q_{{$question->id}}">
	           	<p>{{$question->title}}</p> 	
	           	   @if(!empty($question->options))
	         	   		@foreach ($question->options as $optk => $option)
	         	   		 

		         	   		<div class="option">
		         	   				<span>Options {{($optk+1)}} </span> 
		         	   				<input type="text" name="question[{{$question->id}}][option][{{$optk}}][value]" value="{{$option}}">
		         	   				<div class="option_goldstar">	  
				         	   				<input 
				         	   				type="checkbox" 
				         	   				id="jq_{{$question->id}}_option_{{$optk}}_star" 
				         	   				name="question[{{$question->id}}][option][{{$optk}}][goldstar]" 
				         	   				value="goldstar" 
				         	   				{{ (!empty($question->goldstar) &&  (in_array($option,$question->goldstar)))?'checked':''}}
				         	   				/>	
				         	   				<label for="jq_{{$question->id}}_option_{{$optk}}_star" class="goldStar"><i class="fa fa-star"></i>Gold Star</label>
		         	   				</div>

		         	   				<div class="option_preffer">	  
				         	   				<input 
				         	   				type="checkbox" 
				         	   				id="jq_{{$question->id}}_option_{{$optk}}_preffer" 
				         	   				name="question[{{$question->id}}][option][{{$optk}}][preffer]" 
				         	   				value="preffer" 
				         	   				{{ (!empty($question->preffer) &&  (in_array($option,$question->preffer)))?'checked':''}}
				         	   				/>	
				         	   				<label for="jq_{{$question->id}}_option_{{$optk}}_preffer" class="goldStar">Preffer</label>
		         	   				</div>


		         	   		</div>
	            		@endforeach
	            	@endif     

		      
	         
	         </div>
	    @endforeach
				    @endif

 </div> 


      <a class="btn btn-primary btnPrevious text-white"onclick="scrollToTop()" >Previous</a>
    {{-- <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a> --}}


</div>

