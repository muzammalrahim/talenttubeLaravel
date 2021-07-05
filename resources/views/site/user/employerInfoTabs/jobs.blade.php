<div class="tab_about tab_cont">
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
                    $jobType = 'casual';
                }
                elseif ($job->type == 'full_time') {
                    $jobType = 'Full time';
                }
                elseif ($job->type == 'part_time') {
                    $jobType = 'Part time';
                }
            @endphp
            <div class="job_row">

                <div class="job_heading p10">
                    <h3 class=" job_title"><a>{{$job->title}}</a></h3>
                    <div class="job_location">
                        <span>Location : </span> {{$job->city}}, {{$job->state}}, {{$job->country}}
                    </div>
                </div>
                <div class="job_info row p10 dblock">
                    <div class="w_25p"><div class="j_label bold">Job Type</div><div class="j_value">{{$jobType}}</div></div>
                    <div class="w_25p"><div class="j_label bold">Job Experience</div>
                        <div class="j_value">
                            @if (!empty($experience))
                                @foreach ($experience as $industry)
                                    {{ getIndustryName($industry) }}
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="w_25p"><div class="j_label bold">Job Salary</div><div class="j_value">{{$job->salary}}</div></div>
                    {{-- <div class="w_25p"><div class="j_label bold">Job Category</div><div class="j_value">Web & E-com</div></div> --}}
                </div>
                <div class="job_detail p10"><div class="j_label bold">Job Detail</div> <div>{{$job->description}}</div></div>
                <div class="job_footer p10">
                    <div class="w_25p"><div class="j_label bold">Application</div>
                        <div class="j_value">{{($job->applicationCount)?($job->applicationCount->aggregate):0}}</div>
                    </div>
                    
                    <div class="w_25p fl_right"><div class="j_button">
                        <a class="jobApplyBtn graybtn jbtn" data-jobid="{{$job->id}}">Apply</a></div>
                    </div>
                </div>

            </div>
            @endforeach
            @endif

    </div>