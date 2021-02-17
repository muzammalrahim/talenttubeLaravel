<form method="POST" name="saveInterviewResponse" class="saveInterviewResponse">

    <div class="job_row interviewBookingsRow_24">
      <div class="mb20"></div>
      <div class="job_heading p10">
        <div class="w_80p">
          <h3 class=" job_title"><a> <b>Invitation 1: </b> Interview from {{$UserInterview->employer->name}}</a></h3>
        </div>
        <div class="fl_right">
            <div class="j_label bold">
              Status:
            </div>
            <div class="j_value text_capital">
              {{$UserInterview->status}}
            </div>
        </div>
      </div>

      <div class="job_info row p10 dblock">
        <div class="timeTable">
          <div class="IndustrySelect">
            <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
            @if ($UserInterview->template->type == 'phone_screeen' )
              <p class="p0 qualifType"> Template Type: <b> Phone Screen</b> </p>
            @else
              <p class="p0 qualifType"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
            @endif
            <p class="p0 qualifType"> Interviewer Name: <b> {{$UserInterview->employer->name}} </b> </p>
          </div>
        </div>

        <input type="hidden" name="userInterviewId" value="{{$UserInterview->id}}">
        <input type="hidden" name="temp_id" value="{{$UserInterview->template->id}}">
        <input type="hidden" name="emp_id" value="{{$UserInterview->employer->id}}">
        <div class="timeTable">
          <div class="IndustrySelect">
            <p class="p0 qualifType center bold"> Template Questions </p>
              {{-- @dump($UserInterview->tempQuestions) --}}
              @foreach ($InterviewTempQuestion as $key=> $quest)
                {{-- @dump($quest->question) --}}
                <p class="p0 qualifType" name = ""> {{$quest->question}} </p>
                <input type="text" class="w100" name="answer[{{$quest->id}}]">
              @endforeach
          </div>
        </div>
        <div class="actionButton mt20">
          <button class="btn small leftMargin turquoise saveResponseAsJobseeker" data_url = "{{$UserInterview->url}}">Save Reponse</button>
        </div>
        <p class="errorsInFields qualifType"></p>
      </div>
    </div>
  </form>