<div class="tab-pane fade job-applied" id="job"  role="tabpanel" aria-labelledby="job-tab">
   {{-- <h2>Jobs I Have Applied</h2> --}}
   <div class="row">
      
      <div class="col-md-12">
        <div class="profile profile-section">
            <h2>Jobs I Have Applied</h2>
            <div class="row">
                @if ($jobsApplication->count() > 0)
                @foreach ($jobsApplication as $application)
                <div class="col-sm-12 col-md-12 jobApp_{{$application->id}}">
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

                    <div class="">
                        <div class="job-box-info">
                            <div class="box-head">
                                <h4 class="text-white">{{$job->title}}</h4>
                                Location:<span> {{$job->city}},  {{$job->state}}, {{$job->country}}</span>
                                <i data-toggle="modal" data-target="#jobAppDeleteModal" class="close-box fa fa-times" onclick="deleteJobApp({{$application->id}})"></i>
                            </div>
                            <div class="job-box-text clearfix">
                                <div class="text-info-detail clearfix">
                                    <label>Job Type:</label>
                                    <span>{{$jobType}}</span>
                                </div>
                                <div class="text-info-detail clearfix">
                                    <label class="mt-1">Job Experience:</label>
                                    <span>
                                        @if(!empty($experience))
                                        @foreach($experience as $industry )
                                        <div class="IndustrySelect">
                                            <p class="m-0"><i class="fas fa-angle-right qualifiCationBullet"></i>
                                                {{getIndustryName($industry)}}
                                                <i class="fa fa-trash removeIndustry hide_it"></i>
                                            </p>
                                        </div>
                                        @endforeach
                                        @endif
                                    </span>
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

                                    @php 
                                        $remSpecialCharQues = str_replace("\&#39;","'",$job->description);
                                    @endphp

                                    <p>{{$remSpecialCharQues}} </p>
                                </div>
                                <span class="inreview-tag used-tag">{{$status}}</span>
                            </div>
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
   </div>

   @include('web.user.profile.modal.deletejobapplication') {{-- web/user/profile/modal/deletejobapplication --}}
   
</div>

