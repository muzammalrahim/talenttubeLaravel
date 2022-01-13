  {{-- <div class="row acceptDiv interviewBookingsRow_{{$UserInterview->id}}">
    <div class="col-6">
       <div class="job-box-info interview-box clearfix">
          <div class="box-head">
             <h4 class="text-white">1: Interview from {{$UserInterview->employer->company}}</h4>
          </div>
          <ul class="job-box-text clearfix">
             <li class="text-info-detail clearfix">
                <label>Status:</label>
                <span> {{$UserInterview->status}} </span>
             </li>
             <li class="text-info-detail clearfix">
                <label>Interview Type:</label>
                <span><b> {{$UserInterview->interview_type}} </b></span>
             </li>
             
          </ul>
          <div class="dual-tags interview-btn-call clearfix float-right">
            <button class="orange_btn rejectButton" onclick="rejectInterviewInvitation('{{$UserInterview->url}}')">Reject</button>
            <button class="blue_btn" onclick="acceptInterviewButton()">Accept</button>
          </div>
        </div>
    </div>
  </div>
 --}}



{{-- ===================================================== Accept hide show =====================================================  --}}


{{-- <form method="POST" name="saveInterviewResponse" class="saveInterviewResponse"> --}}

<div class="col-12 interviewBookingsRow p-0">
   <div class="job-box-info interview-box clearfix">
      <div class="box-head">
         <h4 class="text-white">1: Interview from {{$UserInterview->employer->company}}</h4>
      </div>
      <ul class="job-box-text clearfix">
         {{-- <li class="text-info-detail clearfix">
            <label>Status:</label>
            <span> {{$UserInterview->status}} </span>
         </li> --}}

         <div class="row">
            <label class="col-md-2 font-weight-bold">Status:</label>
            <p class="col-md-4">
               {{$UserInterview->status}}
            </p>

            <label class="col-md-2 font-weight-bold">Template Name:</label>
            <p class="col-md-4">
               {{$UserInterview->template->template_name}}
            </p>

            

         </div>

         <div class="row">
            <label class="col-md-2 font-weight-bold">Template Type:</label>
            <p class="col-md-4">
               {{$UserInterview->template->type}}
            </p>

            <label class="col-md-2 font-weight-bold"> Instructions:</label>
            <p class="col-md-4">
               {{$UserInterview->template->employers_instruction}}
            </p>

         </div>

         {{-- <li class="text-info-detail clearfix">
            <label>Template Name:</label>
            <span><b> {{$UserInterview->template->template_name}} </b></span>
         </li> --}}

         {{-- <li class="text-info-detail clearfix">
            <label>Template Type:</label>
            @if ($UserInterview->template->type == 'phone_screeen' )
              <span><b> Phone Screen </b></span>
            @else
              <span><b> {{$UserInterview->interview_type}} </b></span>
            @endif
         </li> --}}

         {{-- <li class="text-info-detail clearfix">
            <label>Employer's Instructions:</label>
            <span><b> {{$UserInterview->template->employers_instruction}} </b></span>
         </li> --}}

         <div class="row">
            <label class="col-md-2 font-weight-bold">Interviewer Name:</label>
            <p class="col-md-4">
               {{$UserInterview->employer->company}}
            </p>

            <label class="col-md-2 font-weight-bold">Employer's Video:</label>
            {{-- <p class="col-md-4"> --}}
               <div class="video_div pointer col-md-4" data-target = "#employerVideoIntroModal" data-toggle = "modal" onclick="showEmployerVideoIntro( '{{template_video($UserInterview->template->employer_video_intro)}}')"> 
                 <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
               </div>
            {{-- </p> --}}

         </div>

         {{-- <li class="text-info-detail clearfix">
            <label>Interviewer Name:</label>
            <span><b> {{$UserInterview->employer->company}} </b></span>
         </li> --}}
         {{-- <li class="text-info-detail clearfix">
            <label>Employer's Intro:</label>
            <div class="video_div pointer" data-target = "#employerVideoIntroModal" data-toggle = "modal" onclick="showEmployerVideoIntro( '{{template_video($UserInterview->template->employer_video_intro)}}')"> 
              <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
            </div>

         </li> --}}

         {{-- ======================================== Template Questions ======================================== --}}

         <h6 class="font-weight-bold"> Template Questions </h6> 
         <form method="POST" action="{{ route('save_jobSeeker_response_interview') }}" enctype="multipart/form-data" name="saveInterviewResponse" class="saveInterviewResponse">
            @csrf
            @foreach ($InterviewTempQuestion as  $quest)

            <div class="question mt-3">
               {{-- <p class="p0 qualifType bold mt10" name = ""> <span> Question ({{$loop->index+1}}):   </span> {{$quest->question}} </p> --}}
               <label for="exampleFormControlFile1"> <b> Question ({{$loop->index+1}}): </b> {{$quest->question}} </label>
               @if ($quest->video_response == 1)
               <div class="video_response"> 
                  <p> Upload video to answer this question </p> 
                  <input type="file" required  class="question_id form-control-file" id="exampleFormControlFile1" name="answer[{{$quest->id}}][img]" accept="video/mp4,video/x-m4v,video/*">
               </div>
               @else
               <input type="text" class="bg-white form-control jobseekersAnswer_{{ $loop->index }}" required name="answer[{{$quest->id}}]">
               @endif
            </div>
            @endforeach

            <input type="hidden" name="userInterviewId" class="userInterviewId" value="{{$UserInterview->id}}"> 
            <p class="errorsInFields qualifType"></p>
            <div class="actionButton">
               <button class="orange_btn">Save Reponse</button>
            </div>
         </form>


      {{-- ======================================== Template Questions ======================================== --}}
   </ul>

    </div>
</div>





{{-- <script src="{{ asset('js/dropzone/dist/min/dropzone.min.js') }}"></script> --}}

@include('site.user.interviewInvitation.video_responseJs') {{-- site/user/interviewInvitation/video_responseJs --}}   

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js" ></script>



