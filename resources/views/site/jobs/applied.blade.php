
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop

 @section('content')



   <section class="row">
                <div class="col-md-12">
                  <div class="profile profile-section">
                    <h2>Jobs I Have Applied</h2>

                     <div class="row">
                           @if ($applications->count() > 0)
        @foreach ($applications as $application)
        <div class="job_row jobApp_{{$application->id}}">

            @php
                $job = $application->job;
                $experience = json_decode($job->experience);
                $jobType = '';
                if($job->type == 'Contract')
                {
                    $jobType = 'Contract';
                }
                elseif ($job->type == 'temporary') {
                    $jobType = 'Temporary';
                }
                elseif ($job->type == 'casual') {
                    $jobType = 'casual';
                }
                elseif ($job->type == 'full_time') {
                    $jobType = 'Full time';
                }
                elseif ($job->type == 'part_time') {
                    $jobType = 'Part time';
                }

                $status = '';
                // $status = $application->status;
                if ($application->status == 'applied') {
                    $status = 'Applied';
                }
                elseif ($application->status == 'inreview') {
                    $status = 'In Review';
                }
                elseif($application->status == 'interview'){
                    $status = 'Interview';
                }
                else{
                    $status = 'Unsuccessful';
                }


@endphp
<div class="col-sm-12 col-md-6">
    <div class="job-box-info">
        <div class="box-head">
            <h4 class="text-white">{{$job->title}}</h4>
            Location:<span> {{$job->city}},  {{$job->state}}, {{$job->country}}</span></label>
            <i data-toggle="modal" data-target="#myModal" class="close-box fa fa-times"></i>
            </div>
                 <div class="job-box-text clearfix">
                      <div class="text-info-detail clearfix">
                       <label>Job Type:</label>
                       <span>{{$jobType}}</span>
                    </div>
                 <div class="text-info-detail clearfix">
            <label>Job Experience:</label>
            <span>@if(!empty($experience))
             @foreach($experience as $industry )
                <div class="IndustrySelect">
                <p><i class="fas fa-angle-right qualifiCationBullet"></i>
                      {{getIndustryName($industry)}}
                      <i class="fa fa-trash removeIndustry hide_it"></i>
                  </p>
                     </div>
                            @endforeach
                        @endif</span>
                    </div>

            <div class="text-info-detail clearfix">
              <label>Job Salary:</label>
              <span>{{$job->salary}}</span>
            </div>
            <div class="text-info-detail clearfix">
              <label>Submitted:</label>
              <span>{{$application->created_at->format('yy-m-d')}}</span>
            </div>
            <div class="text-info-detail clearfix">
              <label>Job Detailed:</label>
              <p>{{$job->description}} </p>
            </div>
            <span class="inreview-tag used-tag">{{$status}}</span>
          </div>
        </div>
       </div>
       @endforeach
        @else
           <h3>You have not applied to any job yet</h3>
         @endif
     </div>
  </div>
</div>
</section>

                         {{-- ----------------------------------------------------delete modal --------------------------------------------}}
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog delete-applications">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                      <h1 class="modal-title"><i class="fa fa-trash trash-icon"></i>Delete Job Application</h1>
                    </div>
                    <div class="modal-body">
                      <strong>Are you sure you wish to continue?</strong>
                    </div>
                    <div class="dual-footer-btn">
                      <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                      <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button>
                    </div>
                  </div>
                  
                </div>
              </div>


@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script type="text/javascript">
$(document).ready(function() {
    console.log(' new job doc ready  ');

    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    $('.confirmJobAppRemoval').on('click',function(){
        var job_id = $(this).attr('data-jobid');
        console.log(' confirmJobAppRemoval click  job_id ', job_id, $(this) );
        $('.modal.cmodal').removeClass('showLoader').removeClass('showMessage');
        $('.confirm_close').show();

        $('#confirmJobAppDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmJobAppId').val(job_id);
    });

    $(document).on('click','.confirm_jobAppDelete_ok',function(){
        // $('.confirmJobAppDeleteModal  .img_chat').html(getLoader('jobDeleteloader'));
        // $(this).prop('disabled',true);
        // $.modal.close();
        // console.log('job delete button');
        $('.confirmJobAppDeleteModal').addClass('showLoader');
        var job_app_id = $('#deleteConfirmJobAppId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJobApplication/'+job_app_id,
            success: function(data){
                $('.confirmJobAppDeleteModal').removeClass('showLoader').addClass('showMessage');
                if( data.status == 1 ){
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.message);
                    $('.jobApp_'+job_app_id).remove();
                    $('.confirm_close').hide();
                }else{
                    $('.confirmJobAppDeleteModal .apiMessage').html(data.error);
                }
            }
        });

    });

});
</script> --}}
@stop

