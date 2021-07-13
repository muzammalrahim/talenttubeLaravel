@if(isset($jobs))
@if ($jobs->count() > 0)
@foreach ($jobs as $job)


{{-- @include('mobile.modals.jobsModal')          mobile/jobs/jobsModal       --}}

{{-- @dump( $job->questions ) --}}
    {{-- @dump($job->jobEmployer->name) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">

        <div class="card">
            <div class="card-header jobAppHeader p-2 font11">
                <a>{{$job->title}}</a>
                <div class="jobAppStatus float-right">
                    @if ($job->code)
                        <div class="font-weight-bold"> Code: </div>
                        <div class="jobAppStatus">{{$job->code}}</div>
                    @endif
                </div>

                <div>
                    <div class="row p-0 m-0">
                        <span class="font11">Location : </span>
                            <div class="font11" style="margin: 0.2rem 0 0 0.2rem;">
                             {{$job->city}},  {{$job->state}}, {{$job->country}}</div>
                    </div>
                </div>

                    <div class="row p-0 m-0">
                        <span class="font11">Employer : </span>
                            <span class="font11" style="margin: 0.2rem 0 0 0.2rem;"> {{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</span>
                    </div>

            </div>

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">

                    <div class="col-4 p-0">

                        {{-- @dump($job->jobEmployer) --}}

                    {{-- @php
                        $profile_image   = asset('images/mobile/icons/nophoto.jpg');
                        if ($js->profileImage){
                        $profile_image = asset('images/user/'.$js->id.'/gallery/'.$js->profileImage->image);
                    }

                    @endphp
                        <img lass="img-fluid z-depth-1" src="{{$profile_image}}"> --}}

                        @php
                        $user_gallery  =  $job->jobEmployerLogo;
                        $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                        @endphp
                    <img  class="img-fluid z-depth-1" id="pic_main_img" src="{{$profile_image}}" title="">

                       {{--  <img class="img-fluid z-depth-1" src="https://media-exp1.licdn.com/dms/image/C5103AQHK0mH7N_EvGg/profile-displayphoto-shrink_200_200/0?e=1601510400&v=beta&t=mxpoqv7XzDVLr_ACQKTkPsIKa5wSLg7JMke622gyR1U" style="height:110px;"> --}}


                    </div>
                    @php
                    // dd($user->qualification);
                    $industry_experienceData =  json_decode($job->experience);
                    // ?(getIndustriesData($user->industry_experience)):(array());
                   // dd( $industry_experienceData);

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
                    <div class="col p-0 pl-3">

                        <div class="font11 float-left mr-1 font-weight-bold">Job Salary: </div>
                            <div class="jobDetail"> {{ getSalariesRangeLavel($job->salary) }}</div>
                        <div class="mt-2">
                            <span class="font11">Job Experience</span>
                        </div>
                        <div>
                            @if(!empty($industry_experienceData))
                            @foreach($industry_experienceData as  $industry )
                                <div class="IndustrySelect">
                                      <input type="hidden" name="industry_experience[]" class="industry_experience" value="{{$industry}}">
                                      <p>
                                        <i class="fas fa-angle-right qualifiCationBullet"></i>
                                          {{getIndustryName($industry)}}

                                </div>
                            @endforeach
                        @endif
                        </div>


                    </div>

                </div>

                <div class="row p-0 mt-2">
                    <div class="card-title col p-0 mb-0 font11 font-weight-bold">Job Detail:</div>
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
<div class="jobs_pagination cpagination">{!! $jobs->render() !!}</div>
@endif
@endif
