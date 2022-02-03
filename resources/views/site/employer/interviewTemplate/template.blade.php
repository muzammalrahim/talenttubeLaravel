{{-- 
<form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation">
   --}}
   <div class="container1 p-0">
      @foreach ($interviewTemplate as $template)
      <div class="notes note_{{$template->id}} mb10">
         <div class="mb10">
            <h5> <b> Template  </b> <b {{-- class="test qualifType" --}}>{{$template->index+1}}: </b></h5>
            
            <div class="qualifType">
               <span class="d-block"> <b> Name: </b> {{$template->template_name}} </span>
               <span class="d-block"> <b>Type: </b> {{$template->type}} </span>

               @if ($template->employers_instruction)

                  {{-- <label class="bold"></label> --}}
                  <span class="d-block"> <b> Instructions: </b> {{ $template->employers_instruction }}</span> 
         
               @endif
            </div>

         </div>
         
      </div>
      @endforeach
      <h5 class="{{-- text-start --}} text-center bold"> Questions </h5>
      @foreach ($InterviewTempQuestion as $key=> $quest)
      <div class="qualifType mt-1"> <b> Question:{{$loop->index+1}}  </b> </div>
      <div class="row">
         <div class="col-9">
            <span class="test qualifType" name = "question[{{$key+1}}]">{{$quest->question}} </span>
         </div>

         <div class="col-3 form-check">
            <input type="checkbox" {{($quest->video_response == 1)? 'checked': ''}} id="flexCheckDefault" class="h-auto" />
           <label class="form-check-label" for="flexCheckDefault">
             Video Response
           </label>
         </div>

         {{-- <div class="w20">
            <input type="checkbox" {{($quest->video_response == 1)? 'checked': ''}}> Video Response
         </div> --}}


      </div>
      <input type="text" class="form-control bg-white hide_it answersInput" name="answer[{{$quest->id}}]">
      @endforeach
      <input type="hidden" name="temp_id" value="{{$template->id}}"> 
      <div class="mt10">
         <button class="btn small leftMargin turquoise conductInterview123 orange_btn" value="{{$template->id}}" >Correspondence Interview</button> 
         <span class="btn small leftMargin turquoise liveInterviewButton pointer blue_btn" value="{{$template->id}}" >Live Interview</span> 
         <button class="btn small leftMargin turquoise liveInterview pointer hide_it orange_btn" value="{{$template->id}}" >Save Response</button> 
      </div>
      <p>
         <span class="recordalreadExist hide_it"></span>
         <span class="liveInterviewError hide_it"></span> 
      </p>
   </div>
   {{-- 
</form>
--}}
<style type="text/css">
   .columnCenters1{ padding-top: 0px !important;}
   .template:nth-child(odd) { background-color:#e0e0e0;}
   .liveInterviewButton { background: #40c7db;padding: 7px 25px;color: white;}
   .liveInterviewButton:hover{background: #015761;}
</style>
{{-- 
@stop --}}