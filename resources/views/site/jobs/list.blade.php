

@if ($jobs && $jobs->count() > 0)

    @foreach ($jobs as $job)
        <div class="job_row">
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
            <div class="job_heading p10">
                <h3 class=" job_title"><a>{{$job->title}}</a></h3>
                @if ($job->code)
                     <div class="job_code">Code: {{$job->code}}</div>
                @endif
                <div class="job_employer">Employer: {{ $job->jobEmployer->name.' '.$job->jobEmployer->surname }}</div>

                <div class="job_location">
                    <span>Location : </span>{{$job->city}},  {{$job->state}}, {{$job->country}}
                </div>
            </div>

            <div class="job_info row p10 dblock">

                <div class="w_25p companyLogo">
                    @php
                        $user_gallery  =  $job->jobEmployerLogo;
                        $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                    @endphp
                    <img class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
                </div>

                {{-- <div class="w_25p">
                    <div class="j_label bold">Job Type</div>
                    <div class="j_value">{{$job->type}}</div>
                </div> --}}

                <div class="w_25p">
                    <div class="j_label bold">Job Experience</div>
                    <div class="j_value">
                        @if(!empty($experience))
                        @foreach($experience as $industry )
                            <div class="IndustrySelect">
                                <p>
                                    <i class="fas fa-angle-right qualifiCationBullet"></i>
                                      {{getIndustryName($industry)}}
                                      <i class="fa fa-trash removeIndustry hide_it"></i></p>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="w_25p">
                    <div class="j_label bold">Job Salary</div>
                    <div class="j_value">{{$job->salary}}</div>
                </div>

            </div>

            <div class="job_detail p10">
                <div class="j_label bold">Job Detail</div>
                <div>{{$job->description}}</div>
            </div>

            <div class="job_footer p10">
                <div class="w_25p">
                    <div class="j_label bold">Expire on</div>
                    <div class="j_value">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</div>
                </div>


                {{-- <div class="w_25p">
                    <div class="j_label bold">Job Likes</div>
                    <div class="j_value">300</div>
                </div> --}}

                <div class="w_25p">
                    <div class="j_label bold">Applications</div>
                    <div class="j_value">{{($job->applicationCount)?($job->applicationCount->aggregate):0}}</div>
                </div>

                 <div class="w_25p jobsType">
                    <div class="j_label bold">Job Type</div>
                    <div class="j_value">{{$jobType}}</div>
                </div>

                <div class="w_25p fl_right">
                    <div class="j_button fl_right"><a class="jobApplyBtn graybtn jbtn" data-jobid="{{$job->id}}">Apply</a></div>
                    <div class="j_button fl_right"><a class="jobDetailBtn graybtn jbtn m5" href="{{route('jobDetail', ['id' => $job->id]) }}">Detail</a></div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="jobs_pagination cpagination">{!! $jobs->render() !!}</div>

@endif
