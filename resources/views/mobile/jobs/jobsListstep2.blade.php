

@if(isset($jobs))
@if ($jobs->count() > 0)
@foreach ($jobs as $job)


    {{-- @include('mobile.modals.jobsModal')          mobile/jobs/jobsModal       --}}

    {{-- @dump( $job->questions ) --}}
    {{-- @dump($job->jobEmployer->name) --}}
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
            $jobType = 'Full time';
        }
        elseif ($job->type == 'part_time') {
            $jobType = 'Part time';
        }
    @endphp
    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">

        <div class="card">
            <div class="card-header jobAppHeader p-2 jobInfoFont">
                <a class="p-0 m-0">{{$job->title}}</a>
                <div class="jobAppStatus float-right">
                    @if ($job->code)
                        <div class="font-weight-bold"> Code: </div>
                        <div class="jobAppStatus">{{$job->code}}</div>
                    @endif
                </div>

                {{-- <div> --}}
                    <div class="row p-0 m-0">
                        <span class="jobInfoFont">Location : </span>
                            <div class="jobDetail ml-1">{{$job->city}},  {{$job->state}}, {{$job->country}}</div>
                    </div>
                {{-- </div> --}}

                <div class="row p-0 m-0">
                    <span class="jobInfoFont">Company : </span>
                        <span class="jobDetail ml-1" > {{ $job->jobEmployer->company}}</span>
                </div>

            </div>

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">

                    <div class="col-4 p-0">
                        <div class="companyLogo">
                            @php
                                $user_gallery  =  $job->jobEmployerLogo;
                                $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                            @endphp
                            <img class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                        </div>
                    </div>

                    <div class="col p-0 pl-3 ml-3">

                        <div class="jobInfoFont float-left mr-1">Job Salary: </div>
                            <div class="jobDetail" > {{$job->salary}}</div>
                        <div class="mt-2">
                            <span class="jobInfoFont">Job Experience</span>
                        </div>
                        <div>
                            @if (!empty($experience))
                            
                                @foreach ($experience as $industry)
                                    {{ getIndustryName($industry) }}
                                @endforeach
                            
                            @endif

                        </div>
                    </div>

                </div>

                <div class="row p-0 mt-2">
                    <div class="card-title col p-0 mb-0 jobInfoFont">Job Detail</div>
                </div>
                <p class="card-text jobDetail row">{{$job->description}}</p>

            </div>

            <div class="card-footer text-muted jobAppFooter">
                <div class="row jobInfo jobFooter ">
                    <div class="col p-0"><span>Expire on</span><br>
                        {{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}
                    </div>

                    <div class="col p-0"> <button class="applicationsCount btn btn-sm btn-primary btn-xs">Applications
                        ({{($job->applicationCount)?($job->applicationCount->aggregate):0}})
                    </button>

                    </div>

                    <div class="p-0 float-right mr-2"><span>Job Type</span><br>
                        {{$jobType}}
                    </div>
                </div>

                <div class="card-footer row p-0 mt-3">
                    <div class="col p-0">
                        <a class="jobDetailBtn graybtn jbtn m5 btn btn-sm btn-primary ml-0 btn-xs" href="{{route('MjobDetail', ['id' => $job->id]) }}">Detail</a>
                    </div>

                    <div class="float-right">
                        {{-- <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" href="{{route('MjobApplyInfo', ['id' => $job->id])}}" job-id ="{{$job->id}}" job-title="{{$job->title}}" data-toggle="modal" data-target="#modalJobApply" >Apply</a> --}}


                        <a class="jobApplyBtn graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" job-id ="{{$job->id}}" job-title="{{$job->title}}">Apply</a>


                    </div>

                </div>

            </div>

        </div>

    </div>

@endforeach
@endif
@endif



<div class="modal fade right" id="modalJobApply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Submit Proposal</p>
        <button type="button" class="close modalCloseTopButton" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">×</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body p-2 mt-2">
        <div class="text-center applyJobModalHeader">           
          <p><strong class="jobTitle font-weight-bold ">Job Title</strong></p> 
          <p class="jobInfoFont row m-0">
            <strong>
              Almost done, few questions before your resume is accepted for this job.
            </strong>
          </p>
        </div>
        <hr>
        <div class="applyJobModalProcessing">
          <div class="text-center mt-3"><i class="far fa-file-alt fa-4x mb-3 animated rotateIn"></i></div>
        </div>
        <div class="jobApplyModalContent d-none"></div>
        <input type="hidden" name="openModalJobId" value="" id="openModalJobId" >
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
    
    // ======================================== Apply For Job Js and Ajax ========================================

$(document).on('click','.jobApplyBtn', function() {
    console.log(' jobApplyBtn click  ');
    var jobPopId = parseInt($(this).attr('job-id'));
    var jobPopTitle = $(this).attr('job-title');
    $('.jobTitle').text(jobPopTitle);
    $('#openModalJobId').val(jobPopId);
    $('#modalJobApply').modal('show');

    $.ajax({
        type: 'GET',
            url: base_url+'/m/ajax/MjobApplyInfo/'+ jobPopId,
            success: function(data){
                console.log("apply for job call");
                $('.applyJobModalProcessing').addClass('d-none');
                $('.jobApplyModalContent').removeClass('d-none');
                $('.jobApplyModalContent').html(data);
                // $('#modalJobApply').modal('hide');

            }
        });

});




</script>