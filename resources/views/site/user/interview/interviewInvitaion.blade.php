

@extends('web.user.usermaster')

@section('custom_css')

@stop

@section('content')

@section('content')
<section class="row">
  <div class="col-md-12">
    <div class="profile profile-section">
      <div class="row">
        <div class="col-11 col-sm-6"><h2>Received Interview Invitations</h2></div>

        <div class="col-1 col-sm-6 head icon_head_browse_matches float-right"> 
          <a href="{{ route('unhideInterviews') }}" class="unhideInterviews blue_btn py-1 float-right">Click here to Un-Hide your interviews </a> 
        </div>
      </div>
      <div class="row">
      @if ($Interviews_booking->count() > 0)
      @foreach ($Interviews_booking   as $Int_booking)
        {{-- @dump($Int_booking->id) --}}
        <div class="col-sm-12 col-md-6 interviewBookingsRow_{{$Int_booking->id}}">
          <div class="job-box-info interview-box clearfix">
            <div class="box-head">
              <h4>{{$loop->index+1}}: Interview from {{$Int_booking->employer->company}}</h4>                          
            </div>
            <ul class="job-box-text clearfix">
              <li class="text-info-detail clearfix">
                <label>Select Status:</label>
                <span>
                  <form class="statusOfInterview d-contents" name="statusOfInterview">  
                    @csrf
                    <select class="selectpicker w-100" name="hide" style="background: #fff !important;">
                      <option value= "0"> Select Status   </option> 
                      <option value= "yes"> Hide Interview </option> 
                      @if ($Int_booking->status == 'pending')
                        <option value= "decline"> Decline Interview </option> 
                      @endif
                    </select>
                    <input type="hidden" class="interview_id" name="interview_id" value="{{$Int_booking->id}}">
                  </form>
                </span>
              </li>
              @if ($Int_booking->template->type == "phone_screeen")
              <li class="text-info-detail clearfix">
                <label>Template Name:</label>
                <span><b> Phone Screen</b></span>
              </li>
              @else
              <li class="text-info-detail clearfix">
                <label>Interview Type:</label>
                <span><b> {{$Int_booking->template->type}} </b></span>
              </li>
              @endif

              <li class="text-info-detail clearfix">
                <label>Interview Name:</label>
                <span><b> {{$Int_booking->template->template_name}} </b></span>
              </li>

              <li style="height: 50px;overflow-y: auto;">
                <span>  Instructions:</span><span> <b> {{$Int_booking->template->employers_instruction}} </b></span>
              </li>

            </ul>
            <div class="dual-tags interview-btn-call clearfix">
              @if ($Int_booking->status == "Interview Confirmed" )
              <a  href="{{ route('interviewInvitationUrl',['url' =>$Int_booking->url]) }}" data-jobid="{{$Int_booking->id}}" type="button"
                class="interview-tag">View My Responses</a>
                <span class="pendinginterview-tag used-tag pull-right">{{$Int_booking->status}}</span>

                @elseif($Int_booking->status == "Rejected")

                <a  href="{{ route('interviewInvitationUrl',['url' =>$Int_booking->url]) }}" data-jobid="{{$Int_booking->id}}" type="button"
                class="interview-tag">You have rejected this interview</a>
                <span class="pendinginterview-tag used-tag pull-right">{{$Int_booking->status}}</span>

                @elseif($Int_booking->status == "Accepted")

                <a  href="{{ route('interviewInvitationUrl',['url' =>$Int_booking->url]) }}" data-jobid="{{$Int_booking->id}}" type="button"
                class="interview-tag">Click here to respond to this interview</a>
                <span class="pendinginterview-tag used-tag pull-right">{{$Int_booking->status}}</span>

              @else
                {{-- <a href="{{ route('interviewInvitationUrl',['url' =>$Int_booking->url]) }}" data-jobid="{{$Int_booking->id}}" type="button"
                class="interview-tag">Click here to respond to this interview</a>  --}}
                <div class="float-left acceptInterviewDiv_{{ $Int_booking->id }}">
                  <button type="button" class="blue_btn" data-target = "#acceptOrRejectInterview" data-toggle = "modal" 
                  onclick="acceptInterviewFun('{{ $Int_booking->url }}', '{{ $Int_booking->id }}')">Click here to respond to this interview</button> 
                </div>

                <span class="pendinginterview-tag used-tag pull-right intStatus_{{ $Int_booking->id }}">{{$Int_booking->status}}</span>
              @endif

              </div>
            </div>
          </div>  
          @php
          $question = $Int_booking->tempQuestions;
          @endphp
          @endforeach  
          @else
          <h3> You have not received any interview invitation yet.</h3>
          @endif
      </div>
    </div>
  </div>
</section>


<!-- ========================================= Accept or reject interview ========================================= -->
              
<div class="modal fade" id="acceptOrRejectInterview" role="dialog">
    <div class="modal-dialog delete-applications">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
          {{-- <h1 class="modal-title"><i class="fas fa-thumbs-down trash-icon"></i>UnLike User</h1> --}}
        </div>
        <div class="modal-body">
          <strong>Would you like to accept or reject this interview ?</strong>
        </div>
        <input type="hidden" id="interviewUrl" name="">
        <input type="hidden" id="interviewId" name="">
        <div class="dual-footer-btn">
          <button type="button" class="btn btn-default black_btn" onclick="rejectInterviewInvitation()" data-dismiss="modal"><i class="fa fa-times"></i>Reject</button>
          <button type="button" class="orange_btn" onclick="acceptInterviewButton()" data-dismiss="modal"><i class="fa fa-check" ></i>Accept</button>
        </div>
      </div>
      
    </div>
</div>

<!-- ========================================= Accept or reject interview end here ========================================= -->


@include('site.user.interview.popup')
@stop

@section('custom_footer_css')

<style type="text/css"> 

.job-box-info>.interview-btn-call>.pendinginterview-tag {
    height: auto !important;
    text-align: center;
}
.job-box-info>.interview-btn-call>.interview-tag {
    text-align: center;
}
</style>

@stop

@section('custom_js')



<script type="text/javascript" src="{{ asset('js/web/interview.js') }}"></script>
<script type="text/javascript">


$(document).ready(function(){

  $(document).on("click" , ".seeDetailOfInterview" , function(){
    // console.log("Hi Interview Invitaion Button");
    $(this).parents('.job_row').find('.timeTable11').toggleClass('hide_it');
  });

  $(document).on("click" , ".confirmInterview" , function(){
    var abcdef = $(this).attr('data-intId');
    // console.log(abcdef);

    var formdate = $(this).parents('.confirmSubmitInterview').serializeArray();
    console.log(formdate);
    
    // Ajax call

    $('.general_error').html('');
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/confirmInterInvitation',
        data: formdate,
        success: function(data){

            $('.loginEditInterview').html('Save').prop('disabled',false);
            if( data.status == 1 ){
                window.location.replace(data.route);
            }else{

                if(data.validator != undefined){
                    const keys = Object.keys(data.validator);
                    for (const key of keys) {
                        if($('#'+key+'_error').length > 0){
                            $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                        }
                    }

                    setTimeout(() => {
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_show').addClass('to_hide');
                            }
                        }
                    }
                        ,3000);
                }
               if(data.error != undefined){
                 //$('.general_error').html('<p>Error Creating new Booking</p>').removeClass('to_hide').addClass('to_show');
                 $('.general_error').append(data.error);
               }
               setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
            }

        }
    });


    // Ajax call end here
  
  });






});

</script>
@stop

