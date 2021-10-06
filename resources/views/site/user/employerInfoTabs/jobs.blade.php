



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
                    $jobType = 'casual';
                }
                elseif ($job->type == 'full_time') {
                    $jobType = 'Full time';
                }
                elseif ($job->type == 'part_time') {
                    $jobType = 'Part time';
                }
            @endphp

     <div class="col-md-6 col-sm-12">
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
                                            <label>Job Experience:</label>
                                                @if (!empty($experience))
                                                @foreach ($experience as $industry)
                                                   <span> {{ getIndustryName($industry) }}</span>
                                                @endforeach
                                                @endif
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Salary:</label>
                                            <span>{{$job->salary}}</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Applications:</label>
                                            <span>{{($job->applicationCount)?($job->applicationCount->aggregate):0}}</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Detailed:</label>
                                            <p>{{$job->description}} </p>
                                          </div>
                                          <a class="interview-tag used-tag text-white cursor-pointer" href="">Apply</a>
                                        </div>
                                      </div>
    </div>
         @endforeach
            @endif