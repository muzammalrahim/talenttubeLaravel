{{-- @dump($UserInterview) --}}
@extends('web.employer.employermaster')
@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop
@section('content')

{{-- html for interview page --}}
<section class="row">
    <div class="col-md-12">
        <div class="profile profile-section">
            <div class="row mb-2 mb-sm-2 mb-md-1 ">
                <h2 class="col-12 col-sm-12 col-md-6 col-lg-6 ps-3"> Interview Invitations</h2>
                <div class="col-12 col-sm-12 col-md-5 col-lg-6">   
                    <a href="{{ route('unhideInterviews') }}" class="unhideInterviews blue_btn float-none float-md-right float-lg-right py-1 "> Click here to Un-Hide your interviews </a>
                </div>
            </div>
      <div class="row">
         @if ($UserInterview->count() > 0)
         @foreach ($UserInterview   as $interview)
         <div class="col-sm-12 col-md-6 interview_{{ $interview->id }}">
            <div class="job-box-info interview-box clearfix">
               <div class="box-head">
                  <h4>Invitation {{$loop->index+1}}: Interview with {{$interview->js->name}}</h4>
               </div>
               <ul class="job-box-text clearfix">
                  <li class="text-info-detail clearfix">
                     <label>Select Status:</label>
                     <span>
                        <form class="statusOfInterview d-contents" name="statusOfInterview">
                           @csrf
                           <select name="hide" class="form-control icon_show" style="background: #fff !important;">
                              <option value= "0"> Select Status   </option>
                              <option value= "yes"> Hide Interview </option>
                              @if ($interview->status == 'pending')
                              <option value= "decline"> Decline Interview </option>
                              @endif
                           </select>
                           <input type="hidden" class="interview_id" name="interview_id" value="{{$interview->id}}">
                        </form>
                     </span>
                  </li>
                  <li class="text-info-detail clearfix">
                     <label>Template Name:</label>
                     <span>{{$interview->template->template_name}}</span>
                  </li>
                  <li class="text-info-detail clearfix">
                     <label>Interview Type:</label>
                     @if ($interview->template->type == "phone_screen")
                     <span> <b> Phone Screen</b> </span>
                     @else
                     <span class="p0 qualifType text-capitalize">  <b> {{$interview->template->type}} </b> </span>
                     @endif
                  </li>
               </ul>
               <div class="dual-tags interview-btn-call clearfix">
                  @if ($interview->status == 'Interview Confirmed')
                     {{-- expr --}}

                     <a href="{{ route('interviewInvitationUrl',['url' =>$interview->url]) }}" data-jobid="{{$interview->id}}" type="button" class="interview-tag">View Response </a>

                  @endif
                  
                  <span class="pendinginterview-tag used-tag pull-right h-auto font-unset text-capitalize">{{$interview->status}}</span>
               </div>
            </div>
         </div>
         @endforeach  
         @else
         <h3> You have not booked any interview yet</h3>
         @endif
      </div>
   </div>
</section>
@stop
@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
<style>
   /*.timeTable{width: 33%;display: block;}
   .width75p{width: 75%;display: inline-block;}
   .bgColor{background: #dddfe3;}
   .confirmInterview{margin: 15px 0 !important;}*/
   @media only screen and (max-width: 991px) {
    .sidebaricontoggle{
        top: 5rem !important;
        margin-top: 10px !important;
    }
   }
</style>
@stop
@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
<script src="{{ asset('js/web/profile.js') }}"></script>
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
   
   
   
     // ========================================================= Change Status of interview =========================================================
   
     $('.statusOfInterview').on('change',function() {
       event.preventDefault();
       var formData = $(this).serializeArray();
       var interview_id = $(this).closest('.statusOfInterview').find('.interview_id').val();
       console.log(' formData ', formData);
       $('.general_error1').html('');
       $.ajax({
           type: 'POST',
           url: base_url+'/ajax/userInterview/hide',
           data: formData,
           success: function(response){
               console.log(' response ', response);
               // $('.selectStatus').html('Send Email').prop('disabled',false);
               $('.interview_'+interview_id).remove();
               if( response.status == 1 ){
                   // $('.errorsInFields').text('Notification sent sucessfully');
                   // setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
               }else{
   
                     
               }
   
           }
       });
     });
   
     // ========================================================= Change Status of interview =========================================================
   
   
   
   
   
   
   });
   
</script>
@stop