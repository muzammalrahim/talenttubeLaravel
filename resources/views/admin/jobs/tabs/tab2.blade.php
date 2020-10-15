<div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

    {{-- @dump($record->questions) --}}
    @php
    $questions = json_decode($record->questions, true);
    $qnum = sizeof($questions)-1;
    //dd($questions)
   @endphp

    <div class="col-md-10">
    @if(!empty($record->questions))
        @foreach($record->questions as $keyq => $question)
               <div class="questionbox q_{{$question->id}}">
                <span>Question {{($keyq+1)}} </span>
                <input type="text" value="{{$question['title']}}" class="mt-2 mb-2" name="jq[{{$keyq}}][title]" />

	           	   @if(!empty($question->options))
                            @foreach ($question->options as $key => $option)
                            @php
                            $checked = '';
                            @endphp
		         	   		<div class="option">
		         	   				<span>Options {{($key+1)}} </span>
                                    <input type="text" name="jq[{{$keyq}}][option][{{$key}}][text]" value="{{$option}}" />
		         	   				<div class="option_goldstar">
                                        @if (!empty($question['goldstar']) && count($question['goldstar']) > 0)
                                        @php
                                                if (in_array($key, $question['goldstar'])) {
                                                    $checked = 'checked';
                                                }
                                                else{
                                                    $checked = '';
                                                }
                                        @endphp
                                        @else
                                        @php
                                            $checked = '';
                                        @endphp
                                        @endif
				         	   				<input
				         	   				type="checkbox"
                                            id="jq_{{$keyq}}_option_{{$key}}_goldstar"
                                            name="jq[{{$keyq}}][option][{{$key}}][goldstar]"
                                            value="goldstar"
				         	   				{{$checked}}
				         	   				/>
				         	   				<label for="jq_{{$question->id}}_option_{{$key}}_star" class="goldStar"><i class="fa fa-star"></i>Gold Star</label>
		         	   				</div>

		         	   				<div class="option_preffer">
                                        @if (!empty($question['preffer']) && count($question['preffer']) > 0)
                                        @php
                                                if (in_array($key, $question['preffer'])) {
                                                    $checked = 'checked';
                                                }
                                                else{
                                                    $checked = '';
                                                }
                                        @endphp
                                        @else
                                        @php
                                            $checked = '';
                                        @endphp
                                        @endif
				         	   				<input
				         	   				type="checkbox"
				         	   				id="jq_{{$keyq}}_option_{{$key}}_preffer"
				         	   				name="jq[{{$keyq}}][option][{{$key}}][preffer]"
				         	   				value="preffer"
				         	   				{{$checked}}
				         	   				/>
				         	   				<label for="jq_{{$question->id}}_option_{{$key}}_preffer" class="goldStar">Undiserable</label>
		         	   				</div>

                                    @php
                                    $checked = '';
                                    @endphp
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

