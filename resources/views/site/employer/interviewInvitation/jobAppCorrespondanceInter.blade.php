@extends('web.user.usermaster')

@section('custom_css')

@stop
@section('content')
<div class="newJobCont profile profile-section">

   <h2>Correspondence interview questions</h2>


   @if ($UserInterview->count() > 0)
   @foreach ($UserInterview as $interview)
   {{-- @dd($UserInterview); --}}
   <div class="row">
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Template Name: <b>{{$interview->template->template_name}}</b></p>
            </div>
            <div class="col-sm-12 col-md-6">
               @if ($interview->template->type == 'phone_screeen' )
               <p class="text-dark"> Template Type: <b class="text-capitalize"> Phone Screen</b> </p>
               @else
               <p class="text-dark text-capitalize">Template Type: <b>{{$interview->template->type}}</b></p>
            </div>
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Employer Instructions: <b>{{$interview->template->employers_instruction}}</b></p>
            </div>
            @endif
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Interviewer Name: <b>{{$interview->employer->company}}</b> </p>
            </div>
            @if ($interview->template->employer_video_intro)
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Employr's Intro: 
               <h1 data-target = "#employerVideoIntroModal" data-toggle = "modal" onclick="showEmployerVideoIntro( '{{template_video($interview->template->employer_video_intro)}}')"><i class="fas fa-photo-video"></i></h1>
               </p>
            </div>
            @endif
         </div>



         <div class="row">
            <div class="col-md-12">
               @php
               $tempQuestions = App\InterviewTempQuestion::where('temp_id', $interview->temp_id)->get();
               @endphp
               @foreach ($tempQuestions as $question)
               <div class="question-ans">
                  <p class="accordionone text-light"><b>Question {{$loop->index+1}}:</b>{{$question->question}}</p>
                  @php
                  $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('userInterview_id', $interview->id)->first();   
                  @endphp
                  <div class="panel">
                     @if ($question->video_response == 1 && !isAdmin($user) )
                     <p>
                     <h1 data-toggle="modal" onclick="showEmployerVideoIntro('{{userInterview_answer_video($answers->answer)}}')" 
                        data-target="#employerVideoIntroModal"> <i class="fas fa-photo-video"></i></h1>
                     </p>
                     @else
                     <p class="text-dark"><b>Your Response:</b> {{$answers->answer}} </p>
                     @endif
                  </div>
               </div>
               @endforeach
            </div>
         </div>


   @endforeach
   @endif
         



   
  
   <div class="modal fade" id="employerVideoIntroModal" role="dialog">
    <div class="modal-dialog delete-applications">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
          {{-- <h1 class="modal-title"><i class="fas fa-thumbs-down trash-icon"></i>Video</h1> --}}
        </div>
        <div class="modal-body">
          {{-- <strong>Are you sure you wish to continue?</strong> --}}
            <div class="videoBox"></div>
        </div>
        <div class="dual-footer-btn">
          <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
          {{-- <button type="button" class="orange_btn" onclick="confirmUnlikeFunction()" data-dismiss="modal"><i class="fa fa-check" ></i>OK</button> --}}
        </div>
      </div>
      
    </div>
   </div>

</div>
{{-- @include('site.user.interview.popup') --}}
@stop
@section('custom_footer_css')



@stop
@section('custom_js')
<script src="{{ asset('js/web/interview.js') }}"></script>


@stop