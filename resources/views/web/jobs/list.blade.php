<div class="row">
   @if ($jobs && $jobs->count() > 0)
   @foreach ($jobs as $job)
   {{-- @dump($job); --}}
   @php
   $experience = json_decode($job->experience);
   $jobType = '';
   if($job->type == 'Contract'){
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
   <div class="col-sm-12 col-md-6">
      <div class="job-box-info">
         <div class="box-head">
            <h4 class="text-white"> {{$job->title}} </h4>
            <label>Location:<span> {{$job->city}},  {{$job->state}}, {{$job->country}}</span></label>
         </div>
         <div class="row Block-user-wrapper">
            <div class="col-md-4 user-images">
               <div class="block-user-img ">
                  @php
                  $user_gallery  =  $job->jobEmployerLogo;
                  $profile_image =  !empty($user_gallery)?(assetGallery2($user_gallery,'small')):(asset('images/site/icons/nophoto.jpg'));
                  @endphp
                  <img src="{{$profile_image}}" alt="">
               </div>
               <div class="block-user-progress ">
                  <h6>{{ $job->jobEmployer->company}}</h6>
                  {{--  
                  <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                  <div class="block-progrees-ratio d-block d-md-none">
                     <ul>
                        <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                        <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                     </ul>
                  </div>
                  --}}
               </div>
            </div>
            <div class="col-md-8 user-details">
               <div class="mt-2 row blocked-user-about">
                  <h6 class="p-0">Job Type:</h6>
                  <p class="p-0">{{ $jobType }}</p>
               </div>
               <div class="mt-2 row blocked-user-about">
                  <h6 class="p-0">Job Experience:</h6>
                  @if(!empty($experience))
                  @foreach($experience as $industry )
                  <div class="IndustrySelect">
                     <p class="p-0">
                        <i class="fas fa-angle-right"></i>
                        {{getIndustryName($industry)}}
                        <i class="fa fa-trash removeIndustry hide_it"></i>
                     </p>
                  </div>
                  @endforeach
                  @else
                  <p class="p-0">
                     <i class="fas fa-angle-right"></i>
                     No Experience Required
                     <i class="fa fa-trash removeIndustry hide_it"></i>
                  </p>
                  @endif
               </div>
               <div class="mt-2 row blocked-user-about">
                  <h6 class="p-0">Job Sallary:</h6>
                  <p class="p-0">{{$job->salary}}</p>
               </div>
               <div class="mt-2 row blocked-user-about  clearfix">
                  <h6 class="p-0">Job Detailed:</h6>
                  <textarea class="p-0 border-0 site-grey-color">{{$job->description}}</textarea>
               </div>
               <div class="mt-2 row blocked-user-about  clearfix">
                  <h6 class="p-0">Applications:</h6>
                  <p class="p-0">{{($job->applicationCount)?($job->applicationCount->aggregate):0}}</p>
               </div>
               <div class="mt-2 row blocked-user-experience  clearfix">
                  <h6 class="p-0">Expire On:</h6>
                  <p class="p-0">{{ ($job->expiration)?($job->expiration->format('yy-m-d')):''}}</p>
               </div>
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
                     {{-- @dd($job->jobApplication->id) --}}
                     @if (isset($job->jobApplication))
                     @if ($job->jobApplication->user_id == $user->id)
                     {{-- expr --}}
                     <button class="interview-tag used-tag"><i class="far fa-check-circle"></i> Appied </button>
                     @endif
                     @else
                     <button data-toggle="modal" data-target="#jobApplyModal" onclick="jobApplyFunction({{ $job->id }})" class="interview-tag used-tag"><i class="far fa-check-circle"></i> Apply </button>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach
   <div class="jobs_pagination cpagination">{!! $jobs->render() !!}</div>
   @endif
</div>