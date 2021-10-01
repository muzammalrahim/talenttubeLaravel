

  
 @if ($jobs && $jobs->count() > 0)




  @foreach ($jobs as $job)
    
    {{-- @dump($job); --}}
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

    <div class="row">
      <div class="col-sm-12 col-md-6">

        <div class="job-box-info">
          <div class="box-head">
            <h4> {{$job->title}} </h4>
            <!-- <label>Location:<span> Alexandria, New South Wales, Australia</span></label> -->
            <i class="close-box fa fa-times"></i>
          </div>
          <div class="job-box-text clearfix">

            <div class="text-info-detail clearfix">
              <label>Job Type:</label>
              <span>{{ $jobType }}</span>
            </div>
            <div class="text-info-detail clearfix">
              <label>Job Experience:</label>

              @if(!empty($experience))
                @foreach($experience as $industry )
                    <div class="IndustrySelect">
                        <p>
                            <i class="fas fa-angle-right"></i>
                              {{getIndustryName($industry)}}
                              <i class="fa fa-trash removeIndustry hide_it"></i>
                        </p>
                    </div>
                @endforeach
                @endif
              {{-- <span>3 year</span> --}}
            </div>
            <div class="text-info-detail clearfix">
              <label>Job Salary:</label>
              <span>{{$job->salary}}</span>
            </div>
            <div class="text-info-detail clearfix">
              <label>Submitted:</label>
              <span>20-12-2012</span>
            </div>
            <div class="text-info-detail clearfix">
              <label>Job Detailed:</label>
              <p>  {{$job->description}} </p>
            </div>
          </div>
          <div class="bc-footer">
            <div class="row">
              <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="b-heading">
                  <h4> Code: {{$job->code}}</h4>
                </div>
              </div>

              <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="b-card-btn">
                  <a type="button" class="orange_btn" href="{{route('jobDetail', ['id' => $job->id]) }}"> <i class="fas fa-file-alt"></i> Detail</a>
                  <button data-toggle="modal" data-target="#myModal9" class="interview-tag used-tag"><i class="far fa-check-circle"></i> Apply </button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      
    </div>


  @endforeach
    <div class="jobs_pagination cpagination">{!! $jobs->render() !!}</div>

@endif