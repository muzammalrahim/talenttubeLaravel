@extends('web.user.usermaster')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop
@section('content')
<div class="newJobCont">
   <div class="head icon_head_browse_matches">Completed Interviews  </div>
   @if ($UserInterview->count() > 0)
   @foreach ($UserInterview   as $interview)
   <div class="job_row interviewBookingsRow_{{$interview->id}}">
      <div class="job_heading p10">
         <div class="w70 dinline_block">
            <h3 class=" job_title"><a> <b>Invitation {{$loop->index+1}}: </b> Interview of {{$interview->js->name}}</a></h3>
         </div>
         <div class="fl_right">
            <div class="j_label bold">Status:</div>
            <div class="j_value text_capital">{{$interview->status}}</div>
         </div>
      </div>
      <div class="job_info row p10 dblock">
         <div class="timeTable">
            <div class="IndustrySelect">
               <p class="p0 qualifType"> Template Name: <b> {{$interview->template->template_name}} </b> </p>
               @if ($interview->template->type == "phone_screeen")
               <p class="p0 qualifType"> Template Type: <b> Phone Screen</b> </p>
               @else
               <p class="p0 qualifType"> Template Type: <b> {{$interview->template->type}} </b> </p>
               @endif
               <div class="job_info employerResponseDiv row dblock mt10">
                  <div class="j_button pb20">
                     <a class="jobApplyBtn graybtn jbtn seeEmployerResponse">See Candidate's Response</a>
                  </div>
                  @php
                  $temp_id = $interview->temp_id;
                  $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
                  @endphp
                  <div class="employerResponse hide"  >
                     @foreach ($tempQuestions as $question)
                     <p class="qualifType p0"> <b>Question {{$loop->index+1}})</b> {{$question->question}} </p>
                     @php
                     $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('user_id', $id)->first();   
                     @endphp
                     <p class="qualifType p0 mb10"> <b>Candidate's Response:</b> {{$answers->answer}} </p>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach  
   @else
   <h3> This User has not any interview </h3>
   @endif
   <div class="cl"></div>
</div>
{{-- @include('site.user.interview.popup') --}}
@stop
@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<style>
   .width75p{width: 75%;display: inline-block;}
   .bgColor{background: #dddfe3;}
   .confirmInterview{margin: 15px 0 !important;}
   .hide{display: none;}
</style>
@stop
@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script type="text/javascript"></script>
@stop