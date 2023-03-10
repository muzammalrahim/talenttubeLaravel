{{-- html for jobs tab in employers section --}}
@if ($jobs->count() > 0)
@foreach ($jobs as $job)
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
$jobType = 'Casual';
}
elseif ($job->type == 'full_time') {
$jobType = 'Full Time';
}
elseif ($job->type == 'part_time') {
$jobType = 'Part Time';
}
@endphp
<div class="col-md-6 col-sm-6">
   <div class="job-box-info">
      <div class="box-head">
         <h4>{{$job->title}}</h4>
         <label>Location:<span> {{$job->city}}, {{$job->state}}, {{$job->country}}</span></label>
      </div>
      <div class="job-box-text clearfix">
         <div class="text-info-detail clearfix">
            <label>Job Type:</label>
            <span>{{$jobType}}</span>
         </div>
         <div class="text-info-detail clearfix">
            <label>Industry Experience:</label>
            @if (!empty($experience))
            @foreach ($experience as $industry)
            <span> {{ getIndustryName($industry) }}</span>
            @endforeach
            @endif
         </div>
         <div class="text-info-detail clearfix">
            <label>Salary Range:</label>
            <span>{{$job->salary}}</span>
         </div>
         <div class="text-info-detail clearfix">
            <label>Applications:</label>
            <span>{{($job->applicationCount)?($job->applicationCount->aggregate):0}}</span>
         </div>
         <div class="text-info-detail clearfix">
            <label>Job Details:</label>
            <p>{{$job->description}} </p>
         </div>
         {{-- <a class="interview-tag used-tag text-white cursor-pointer" href="">Apply</a> --}}
         
         {{-- @dd($job->jobApplication->id) --}}
         @if (isset($job->jobApplication))
         @if ($job->jobApplication->user_id == $user->id)
         {{-- expr --}}
         <button class="blue_btn float-right">{{-- <i class="far fa-check-circle"></i> --}} Applied </button>
         @endif
         @else
         <button data-toggle="modal" data-target="#jobApplyModal" onclick="jobApplyFunction({{ $job->id }})" class="interview-tag used-tag rounded"><i class="far fa-check-circle"></i> Apply </button>
         @endif

      </div>
   </div>
</div>
@endforeach
@endif


<!-- =====================Apply button modal================================ -->
<div class="modal fade" id="jobApplyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog Apply-modal " role="document">
    <div class="modal-content ">
      <div class="modal-header Apply-modal-header">
        <div class="m-header  ">
          <h4 class="modal-title Apply-modal-title " id="myModalLabel">
            Submit Proposal
          </h4>
          <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
        </div>
      </div>
      <div class="modal-body ">
        <div class="jobData"></div>
      </div>
    </div>
  </div>
</div>