@extends('site.employer.employermaster')
@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop
@section('content')
{{-- html for emloyers job section --}}
<div class="row profile profile-section">
<h2>My Jobs</h2>
<div class="row">
   @if ($jobs->count() > 0)
   @foreach ($jobs as $job)
   {{--  
   <div class="job_row job_{{$job->id}}">
      --}}
      {{-- @dump($job->id) --}}
      @php
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
      @endphp
      <div class="col-sm-12 col-md-6 job_{{ $job->id }}">
         <div class="job-box-info block-box clearfix">
            <div class="box-head">
               <h4 class="text-white">{{$job->title}}</h4>
               <h6>Location: {{$job->city}},  {{($job->state)}}, {{($job->country)}}</h6>
            </div>
            <div class="row Block-user-wrapper">
               <ul class="job-box-text concigerge clearfix">
                  <li class="text-info-detail clearfix">
                     <label>Job Type:</label>
                     <span>{{$jobType}}</span>
                  </li>
                  <li class="text-info-detail clearfix">
                     <label>Job Detail:</label>
                     <p>{{$job->description}}</p>
                  </li>
                  <li class="text-info-detail clearfix">
                     <label>Job Experience:</label>
                     <span>
                        @if(!empty($experience))
                        @foreach($experience as $industry )
                        <ul class="IndustrySelect">
                           <li>{{getIndustryName($industry)}} </li>
                        </ul>
                        @endforeach
                        @endif
                     </span>
                  </li>
                  <li class="text-info-detail clearfix">
                     <label>Job Salary:</label>
                     <span>{{$job->salary}}</span>
                  </li>
                  <li class="text-info-detail clearfix">
                     <label>Expired On:</label>
                     <span>{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</span>
                  </li>
                  <a href="{{route('empJobApplications',['id' => $job->id])}}" class="blue_btn py-2">
                  Applications: <u>{{($job->applicationCount)?($job->applicationCount->aggregate):0}}</u>
                  </a>
               </ul>
            </div>
            <div class="box-footer1 box-footer  clearfix">
               <div class=" employe-btn-group " style="float: right !important; width: 100%!important;">
                  <button class="block-btn" data-toggle="modal" data-target="#deleteJobAsEmployerModal" onclick="deleteJobAsEmployer('{{ $job->id }}')"><i class="fas fa-trash" ></i> Delete</button>
                  <a href="{{route('jobDetail',['id' => $job->id])}}"> <button class="detail-btn" ><i class="fas fa-file-alt"></i> Detail</button></a>
                  <a href="{{route('employerJobEdit',['id' => $job->id])}}"><button class="like-btn"><i class="fas fa-thumbs-up"></i> Edit</button></a>
                  <a href="{{route('advertise',['id' => $job->id])}}"> <button class="like-btn">Advertisement</button></a>
               </div>
            </div>
         </div>
      </div>
      @endforeach
      @else
      <h3>You have not posted any job yet</h3>
      @endif
   </div>
</div>
{{-- modal for unblock user of block page --}}
<!-- ====================================================================================Modal -->
<div class="modal fade" id="deleteJobAsEmployerModal" role="dialog">
   <div class="modal-dialog delete-applications">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
            <h1 class="modal-title"><i class="fas fa-trash trash-icon"></i>Delete Job</h1>
         </div>
         <div class="modal-body">
            <strong>Are you sure you wish to continue?</strong>
            <input type="hidden" name="" id="deleteConfirmJobId">
         </div>
         <div class="dual-footer-btn">
            <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
            <button type="button" class="orange_btn" onclick="confirmDeleteJobAsEmployer()"><i class="fa fa-check"></i>OK</button>
         </div>
      </div>
   </div>
</div>
{{-- html for emloyers job section ends here --}}
@stop
@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">

@stop
@section('custom_js')
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/web/common.js') }}"></script>
<script type="text/javascript">

$(document).ready(function() {
   console.log(' new job doc ready ');
   $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
});

</script>
@stop