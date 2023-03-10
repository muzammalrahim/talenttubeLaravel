{{-- html for job application form in employer page  --}}
<div class="row">
   @if ($applications->count() > 0)
   @foreach ($applications as $application)
   @php
   $js = $application->jobseeker;
   @endphp
   <div class="col-sm-12 col-md-12">
      <div class="job-box-info block-box clearfix">
         <div class="box-head py-4">
            {{-- goldstat questions --}}
            @include('site.layout.parts.jobSeekerProfileStar') {{-- site/layout/parts/jobSeekerProfileStar --}} 
            @if ($application->userOnlineTests ->count() > 0 )
            @foreach ($application->userOnlineTests as $test)
            <span  style="position: absolute; top: 10px; right: 10px;"> Test Result: <b> {{$test->test_result}} </b> </span>
            @endforeach
            @else
            <span  style="position: absolute; top: 10px; right: 10px;"> No Test attempted </span>
            @endif 
         </div>   
         <div class="row Block-user-wrapper">
            <div class="col-md-2">
               <div class="d-none d-md-block  user-images">
                  <div class="block-user-img">
                     @php
                     $profile_image  = asset('images/site/icons/nophoto.jpg');
                     $profile_image_gallery    = $js->profileImage()->first();
                     if ($profile_image_gallery) {
                     $profile_image   = assetGallery2($profile_image_gallery,'small');
                     }
                     @endphp
                     <img src="{{$profile_image}}" class="w-75" alt="" >
                  </div>
                  
                  <div class="block-user-progress ">
                     <h6 class="text-start">{{$js->username}}</h6>


                     {{-- <div class="progress-img"> 
                        <img src="assests/images/user-progressbar.svg" alt="">
                     </div> --}}
                     <div class="text-center">
                        
                        @if($js->vidoes->count() > 0)
                        <i class="fas fa-video js_video_link pointer fa-2x text-center" onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" data-bs-target="#videoShowModal" data-bs-toggle="modal" target="_blank" style="color: #00326F; cursor: pointer;">
                        </i>
                     </div>
                     @endif
                  </div>
               </div>

               {{-- mobile view --}}
               <div class="d-block d-md-none">
                  <div class="d-flex justify-content-between">
                     <div class="w-75">
                        <h2 class="text-start">{{$js->username}}</h2>
                     </div>


                     {{-- <div class="progress-img"> 
                        <img src="assests/images/user-progressbar.svg" alt="">
                     </div> --}}
                     <div>
                        
                        @if($js->vidoes->count() > 0)
                        <i class="fas fa-video js_video_link pointer fa-2x text-center" onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" data-bs-target="#videoShowModal" data-bs-toggle="modal" target="_blank" style="color: #00326F; cursor: pointer;">
                        </i>
                     </div>
                     @endif
                  </div>
                  <div class="block-user-img mx-auto float-none border-0">
                     @php
                     $profile_image  = asset('images/site/icons/nophoto.jpg');
                     $profile_image_gallery    = $js->profileImage()->first();
                     if ($profile_image_gallery) {
                     $profile_image   = assetGallery2($profile_image_gallery,'small');
                     }
                     @endphp
                     <img src="{{$profile_image}}" class="w-75" alt="" >
                  </div>
                  
               </div>
            </div>
            <div class="col-md-10 user-details">
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Recent Job:</h6>
                  <p><b>{{$js->recentJob}}</b> at <b>{{$js->organHeldTitle}}</b></p>
               </div>
               <div class="row blocked-user-experience blocked-user-about mt-2">
                  <h6 class="p-0">Qualifications:</h6>
                  @php
                  $qualification_names =  getQualificationNames($js->qualification)
                  @endphp
                  @if(!empty($qualification_names))
                  {{-- <div class="font13"> --}}
                     
                  <p> <span>Type:</span> <span class="text-capitalize"> {{$js->qualificationType}}</span> </p>
                  {{-- </div> --}}
                  <ul class="p-0">
                     @foreach ($qualification_names as $qnKey => $qnValue)
                     <li class="qualification">
                        <p>{{$qnValue}}</p>
                     </li>
                     @endforeach
                  </ul>
                  @endif
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">About me:</h6>
                  <p>{{$js->about_me}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Interested In:</h6>
                  <p>{{$js->interested_in}}.</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Salary Range:</h6>
                  <p>{{getSalariesRangeLavel($js->salaryRange)}}</p>
               </div>
               <div class="row blocked-user-about mt-2">
                  <h6 class="p-0">Industry Experience:</h6>
                  @if(isset($js->industry_experience))
                  <ul class="p-0">
                     @foreach ($js->industry_experience as $ind)
                     <li style="margin-bottom: 0px;">
                        <p>{{getIndustryName($ind)}} </p>
                     </li>
                     @endforeach
                  </ul>
                  @endif
               </div>

               <div class="row blocked-user-experience mt-2">
                  <h6 class="p-0"> Job Questions/Answers: </h6>
                  {{-- Commented for toggle --}}
                  {{-- <div class="job_app_qa p-0 job_app_{{$application->id}}">
                     <div class="ps-0"><button class="ja_load_qa blue_btn mt-2" data-appid="{{$application->id}}">Question/Answers</button></div>
                     <div class="job_app_qa_box" style="display: none;"></div>
                  </div> --}}

                  {{-- Test --}}
                  <div class="toggle-div p-0">
                     <button class="mt-2 blue_btn toggle-icon">Question/Answers 
                        <i class="fa fa-chevron-down"></i>
                        <i class="fa fa-chevron-up d-none"></i>
                     </button>
                  </div>

                  {{-- <div class="toggle-icon">
                    <i class="fa fa-chevron-down"></i>
                    <i class="fa fa-chevron-up"></i>
                  </div> --}}

                  <div class="test toggle-content p-0" style="display:none">
                     <div class="application_qa pt-2">
                        @php $answers = $application->answers; @endphp
                        @if (!empty($answers))
                        <div class="jobAnswers">
                           @foreach ($answers as $answer)
                           <div class="job_answers">
                              <p class="jqa_q m-0"> <b> Question: {{ $loop->index+1 }} </b> {{$answer->question->title}}</p>
                              <p class="jqa_a m-0"> <b> Answer: </b> {{$answer->answer}}</p>
                           </div>
                           @endforeach
                        </div>
                        @endif
                        <div class="jobAppDescriptionBox">
                           <p class="m-0 jqa_q">{{jobApplicationMandatoryQuestion()}}</p>
                           <p class="m-0 jqa_a text-break">{{ $application->description}}</p>
                        </div>
                     </div>
                  </div>
                  {{-- Test --}}

                  

               </div>
            </div>
         </div>
         <div class="box-footer1 box-footer  clearfix">
            <div class="block-progrees-ratio1 d-block">
               {{-- <div class="job_app_qa job_app_{{$application->id}}">
                  <div class="ps-0 ps-md-3"><button class="ja_load_qa blue_btn" data-appid="{{$application->id}}">Question/Answers</button></div>
                  <div class="job_app_qa_box" style="display: none;"></div>
               </div> --}}
            </div>
             <!-- ================================= Video box ================================= -->
               <div class="block-progrees-ratio d-block d-md-none">
                  <div class="videos_list">
                     @foreach($js->vidoes as $video)
                     <input type="hidden" name="user_video" value="{{$video->file}}">
                     @endforeach
                  </div>
               </div>
               
               {{-- @if($js->vidoes->count() > 0)
               <i class="fas fa-video js_video_link pointer fa-2x" onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" data-bs-target="#videoShowModal" data-bs-toggle="modal" target="_blank" style="color: #00326F; cursor: pointer;">
               </i>
               @endif --}}

               <!-- ================================= Video box ================================= -->
            <div class="employe-btn-group">
               {{-- <div class="col-12 col-sm-6 col-md-6"> --}}
                  
               {{-- Testing --}}
                  <a href="#onlineTestModal"  class="requestTest  detail-btn px-1"data-toggle="modal" data-target="#myModal" data-jobAppId="{{$application->id}}">Request Testing</a>
                  {{-- Application Status --}}
                  @if ($application->status != 'pending')
                  <div class="jobApplicationStatusCont d-inline-block">
                     <select name="jobApplicStatus" class="select_aw jobApplicStatus form-control icon_show" data-application_id="{{$application->id}}" style="height: 33px; margin-top: 10px;">
                     @foreach (jobStatusArray() as $statusK => $statusV)
                     <option value="{{$statusK}}" {{($application->status == $statusK )?'selected="selected"':''}} >{{$statusV}}</option>
                     @endforeach
                     </select>
                  </div>
                  @else
                  <div class="py-3 bold d-inline-block">
                     <span class="m5">Pending</span>
                  </div>
                  @endif
               {{-- </div> --}}
               {{-- Like --}}
               {{-- <div class="col-12 col-sm-6 col-md-6"> --}}

                  @if (in_array($js->id,$likeUsers))
                  <a class="active  like-btn" data-jsid="{{$js->id}}">Liked</a>
                  @else
                  <a class="jsLikeUserBtn  like-btn" data-jsid="{{$js->id}}">Like</a>
                  @endif
                  {{-- view profile --}}
                  <a class="block-btn" href="{{route('jobSeekerInfo',['id'=>$js->id])}}" target="_blank" >View Profile</a>
                  {{-- <a href="{{ route('jobSeekerInfo', ['id'=> $js->id]) }}" target="_blank">
                     <button class="detail-btn"><i class="fas fa-file-alt"></i> View profile</button>
                  </a> --}}
               {{-- </div> --}}
            </div>
         </div>
      </div>
   </div>
   @endforeach
   @endif
</div>
<div class="job_pagination cpagination">{!! $applications->render() !!}</div>
<!-- ====================================================================================Modal -->
