{{-- 
<form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation">
   --}}
   <div class="container1 p-0">
      @foreach ($interviewTemplate as $template)
      <div class="notes note_{{$template->id}} mb10">
         <div class="mb10">
            <h5> <b> Template  </b> <b>{{$template->index+1}}: </b></h5>
            
            <div class="qualifType">
               <span class="d-block"> <b> Name: </b> {{$template->template_name}} </span>
               <span class="d-block"> <b>Type: </b> {{$template->type}} </span>

               @if ($template->employers_instruction)

                  <span class="d-block"> <b> Instructions: </b> {{ $template->employers_instruction }}</span> 
         
               @endif
            </div>

         </div>
         
      </div>
      @endforeach
      <h5 class="text-center bold"> Questions </h5>

      {{-- <form method="POST" action="{{ route('save_jobSeeker_response_interview') }}" enctype="multipart/form-data" name="saveInterviewResponse" class="saveInterviewResponse"> --}}
         @foreach ($InterviewTempQuestion as $key=> $quest)
         <div class="qualifType mt-1"> <b> Question:{{$loop->index+1}}  </b> </div>
         <div class="row">
            <div class="col-12 col-sm-9">
               <span class="test qualifType" name = "question[{{$key+1}}]">{{$quest->question}} </span>
            </div>
            <div class="col-12 col-sm-3 form-check">
               <input type="checkbox" {{($quest->video_response == 1)? 'checked': ''}} id="flexCheckDefault" class="h-auto mr-2" />
               <label class="form-check-label" for="flexCheckDefault">
                  Video Response
               </label>
            </div>
         </div>

         @if ($quest->video_response == 1)
         <div class="video_response"> 
            <p> Upload video to answer this question </p> 
            <input type="file" required  class="question_id form-control-file answersInput hide_it" id="exampleFormControlFile1" name="answer[{{$quest->id}}][img]" accept="video/mp4,video/x-m4v,video/*">
         </div>
         @else
         <input type="text" class="bg-white form-control answersInput hide_it jobseekersAnswer_{{ $loop->index }}" required name="answer[{{$quest->id}}]">
         @endif
         {{-- <input type="text" class="form-control bg-white hide_it answersInput" name="answer[{{$quest->id}}]"> --}}
         @endforeach
         <input type="hidden" name="temp_id" value="{{$template->id}}"> 

         {{-- <input type="hidden" name="userInterviewId" class="userInterviewId" value="{{$UserInterview->id}}">  --}}

         <div class="mt10">
            <button class="btn small leftMargin turquoise conductInterview123 orange_btn" value="{{$template->id}}" >Correspondence Interview</button> 
            <span class="btn small leftMargin turquoise liveInterviewButton pointer blue_btn" value="{{$template->id}}" >Live Interview</span> 
            <button class="btn small leftMargin turquoise liveInterview pointer hide_it orange_btn" value="{{$template->id}}" >Save Response</button> 
            <span class="displayInterviewTemplate btn small orange_btn1"><i class="fa fa-times">  Close</i></span>
         </div>

         <p>
            <span class="recordalreadExist hide_it"></span>
            <span class="liveInterviewError hide_it"></span> 
         </p>
      {{-- </form> --}}
   </div>

<style type="text/css">
   .columnCenters1{ padding-top: 0px !important;}
   .template:nth-child(odd) { background-color:#e0e0e0;}
   .liveInterviewButton { background: #40c7db;padding: 7px 25px;color: white;}
   .liveInterviewButton:hover{background: #015761;}
</style>
